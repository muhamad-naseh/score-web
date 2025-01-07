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

class ListenSensorData implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $subTopic = "0101/sub";


    /**
     * Create a new job instance.
     */
    public function __construct()
    {

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
        try {
            Log::debug("Starting Listen");
            \Cache::put("budi-start", "Starting Listen");
            $mqttClient->subscribe($this->subTopic, function (string $topic, string $message) use ($mqttClient) {
                \Cache::put("budi", $message);
                Log::debug("Incoming Message From Topic :". $topic." With message ".$message );
                $data = explode(',', $message);
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
            $mqttClient->loop(false);
        } catch (DataTransferException|RepositoryException|InvalidMessageException|ProtocolViolationException|MqttClientException $e) {
            Log::error("Job Error", [
                $e->getMessage()
            ]);
        }

    }
}
