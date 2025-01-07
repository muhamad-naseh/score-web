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
use PhpMqtt\Client\Exceptions\MqttClientException;
use PhpMqtt\Client\Exceptions\ProtocolViolationException;
use PhpMqtt\Client\Exceptions\RepositoryException;
use PhpMqtt\Client\Facades\MQTT;

class PublishSensorData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $pubTopic = "0101/pub";
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
        \Cache::put("budi-start", "Starting Listen");
        try {
            $mqttClient->publish($this->pubTopic, $this->payload);
        } catch (DataTransferException|RepositoryException|ProtocolViolationException|MqttClientException $e) {
            Log::error("Job Error", [
                $e->getMessage()
            ]);

        }
    }
}
