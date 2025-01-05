<?php

namespace App\Livewire;

use App\Jobs\RecordScore;
use App\Models\Fight;
use App\Models\FightParticipant;
use Illuminate\Bus\Batch;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Bus;
use Illuminate\View\View;
use Livewire\Component;
use PhpMqtt\Client\Contracts\MqttClient;
use PhpMqtt\Client\Exceptions\DataTransferException;
use PhpMqtt\Client\Exceptions\RepositoryException;
use PhpMqtt\Client\Facades\MQTT;

class RealtimeFightRecorder extends Component
{
    public Fight $fight;

    public bool $matchStatus = false;

    public ?string $batch = null;
    public string $pubTopic = "0101/pub";
    public string $subTopic = "0101/sub";

    protected $listeners = [
        'start' => 'startFight'
    ];


    public function __construct()
    {
    }

    public function mount(Fight $fight): void
    {
        $fight->load(['fightParticipants.player', 'fightParticipants.scores']);
        $this->fight = $fight;
        logger("Booted");
    }

    /**
     * @throws RepositoryException
     * @throws DataTransferException|\Throwable
     */
    public function startFight(): void
    {
        $this->start();
    }

    public function stopFight(): void
    {
        if ($this->batch != null) {
            $batch = Bus::findBatch($this->batch);
            $batch->cancel();
//            $this->matchStatus = false;

        }
        $mqttClient = MQTT::connection();
        $mqttClient->publish("0101/pub", '0,0');
        $mqttClient->disconnect();
    }

    /**
     * @throws \Throwable
     */
    private function start(): void
    {
        $payload = $this->fight->fightParticipants->map(fn(FightParticipant $item) => $item->getKey())->join(',');
        $fight = $this->fight;
        $batch = Bus::batch([new RecordScore($payload)])
            ->before(function (Batch $batch) use ($fight) {
                $fight->status = 'matching';
                $fight->save();
            })->then(function (Batch $batch) {
                // All jobs completed successfully...
            })->catch(function (Batch $batch, \Throwable $e) {
                dd($e);
            })->finally(function (Batch $batch) use ($fight) {
                $fight->status = 'done';
                $fight->save();
            })
            ->dispatch();

        $this->batch = $batch->id;
    }


    public function render(): Application|\Illuminate\Contracts\View\View|Factory|View
    {
        return view('livewire.realtime-fight-recorder');
    }

}
