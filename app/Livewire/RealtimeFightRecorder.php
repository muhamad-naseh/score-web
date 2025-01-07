<?php

namespace App\Livewire;

use App\FightResult;
use App\FightStatus;
use App\Jobs\RecordScore;
use App\Models\Fight;
use App\Models\FightParticipant;
use App\Models\Score;
use Illuminate\Bus\Batch;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Bus;
use Illuminate\View\View;
use Livewire\Component;
use PhpMqtt\Client\Exceptions\DataTransferException;
use PhpMqtt\Client\Exceptions\RepositoryException;
use PhpMqtt\Client\Facades\MQTT;
use Throwable;

class RealtimeFightRecorder extends Component
{
    public Fight $fight;

    public bool $connectionStatus = false;

    public FightStatus $fightStatus;

    public ?string $batch = null;
    public string $pubTopic = "0101/pub";

    public function __construct()
    {
        if (cache()->has("subscriber_job")) {
            $this->batch = cache()->get("subscriber_job");
        }
    }

    public function mount(Fight $fight): void
    {
        $this->fight = $fight;
        $this->fightStatus = $this->fight->status;
    }

    /**
     * @throws Throwable
     */
    public function playPause(): void
    {
        if ($this->fightStatus == FightStatus::MATCHING) {
            $this->pause();
        } else {
            $this->start();
        }
    }

    public function completed(): void
    {
        $this->pause();
        $participants = FightParticipant::query()
            ->withSum('scores', 'value')
            ->whereIn('id', $this->fight->fightParticipants->pluck('id'))
            ->get();

        $win = $participants->sortByDesc('scores_sum_value')->get(0);
        $loose = $participants->sortByDesc('scores_sum_value')->get(1);
        $isDraw = $win->scores_sum_value == $loose->scores_sum_value;
        $win->update([
            'result' => $isDraw ? FightResult::DRAW : FightResult::WIN,
        ]);
        $loose->update([
            'result' => $isDraw ? FightResult::DRAW : FightResult::LOSE,
        ]);
        $this->updateStatus(FightStatus::COMPLETED);
    }

    protected function pause(): void
    {
        try {
            if ($this->batch != null) {
                $batch = Bus::findBatch($this->batch);
                $batch->cancel();
            }

            $mqttClient = MQTT::connection();
            if ($mqttClient->isConnected()) {
                logger("Connection Status " . $mqttClient->isConnected());
                $mqttClient->publish("0101/pub", '0,0');
                $this->updateStatus(FightStatus::PAUSED);
            }
        } catch (DataTransferException|RepositoryException $e) {
            \Log::error($e);
        }
    }

    public function checkStatus(): void
    {
        if ($this->fightStatus == FightStatus::MATCHING) {
            try {
                $mqttClient = MQTT::connection();
                $this->connectionStatus = $mqttClient->isConnected();
            } catch (\Exception $e) {
                $this->connectionStatus = false;
            }
        }
    }

    /**
     * @throws Throwable
     */
    private function start(): void
    {
        $payload = $this->fight->fightParticipants->map(fn(FightParticipant $item) => $item->getKey())->join(',');

        $batch = Bus::batch([new RecordScore($payload)])
            ->before(fn(Batch $batch) => $this->updateStatus(FightStatus::MATCHING))
            ->then(function (Batch $batch) {
                // All jobs completed successfully...
            })
            ->catch(function (Batch $batch, Throwable $e) {
                dd($e);
            })
            ->dispatch();

        $this->batch = $batch->id;
        \Cache::put("subscriber_job", $batch->id);
    }

    protected function updateStatus(FightStatus $status): void
    {
        $this->fightStatus = $status;
        $this->fight->status = $status;
        $this->fight->save();
    }

    public function render(): Application|\Illuminate\Contracts\View\View|Factory|View
    {
        return view('livewire.realtime-fight-recorder');
    }

}
