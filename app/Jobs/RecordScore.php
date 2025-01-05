<?php

namespace App\Jobs;

use App\Models\Score;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use PhpMqtt\Client\Exceptions\DataTransferException;
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
            logger("stoptheconnection");
            $mqttClient->disconnect();
            return;
        }

        try {
            $mqttClient->publish($this->pubTopic, $this->payload);
            $mqttClient->subscribe($this->subTopic, function (string $topic, string $message) use ($mqttClient) {
                logger($message);
                $data = explode(',', $message);
                $result = [
                    'fight_participant_id' => $data[0],
                    'score_type' => $data[1],
                    'score_value' => $data[2],
                ];
                Score::query()->create($result);
                $mqttClient->interrupt();
            }, 1);
            $mqttClient->loop(true, true);

            logger("start");
        } catch (DataTransferException|RepositoryException $e) {
            logger($e->getMessage());
        }

    }
}
