<?php

namespace App\Jobs;

use App\Models\FightParticipant;
use App\Models\Score;
use App\ScoreType;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\Exceptions\DataTransferException;
use PhpMqtt\Client\Exceptions\InvalidMessageException;
use PhpMqtt\Client\Exceptions\MqttClientException;
use PhpMqtt\Client\Exceptions\ProtocolViolationException;
use PhpMqtt\Client\Exceptions\RepositoryException;
use PhpMqtt\Client\Facades\MQTT;

class RecordScore implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $pubTopic = "0101/pub";
    public string $subTopic = "0101/sub";
    public string $payload;


    /**
     * Create a new job instance.
     */
    public function __construct(string $payload)
    {
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mqttClient = MQTT::connection();
        if ($this->batch()->cancelled()) {
            if ($mqttClient->isConnected()){
                $mqttClient->disconnect();
            }
            return;
        }

        \Cache::put("budi-".$this->payload, $this->payload);
        try {
            $mqttClient->publish($this->pubTopic, $this->payload);
            $mqttClient->subscribe($this->subTopic, function (string $topic, string $message) use ($mqttClient) {
                $data = explode(',', $message);

                \Cache::put("budi-msg", $message);
                if (count($data) == 3) {
                    $fightParticipant = FightParticipant::query()->findOrFail(trim($data[0]));
                    $type = ScoreType::tryFrom(trim($data[1]));
                    if ($type != null) {
                        $score = new Score();
                        $score->value = (int) trim($data[2]);
                        $score->type = $type;
                        $score->fightParticipant()->associate($fightParticipant);
                        $score->save();
                    }
                }
            }, 1);
            $mqttClient->loop(true, true);
        } catch (DataTransferException|RepositoryException|InvalidMessageException|ProtocolViolationException|MqttClientException $e) {
            Log::error("Job Error", [
                $e->getMessage()
            ]);
        }

    }
}
