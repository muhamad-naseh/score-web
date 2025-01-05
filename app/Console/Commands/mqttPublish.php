<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class mqttPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:publish {message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MQTT Publish';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $message = $this->argument('message');

        $mqtt = MQTT::connection();

        $this->info("Publish message: {$message}");
        $mqtt->publish('0101/pub', $message, 1);
        $mqtt->subscribe('0101/sub', function (string $topic, string $payload){
            $data = explode(',', $payload);
            $result = [
                'id'=>$data[0],
                'type'=>$data[1],
                'score'=>$data[2],
            ];
            $this->info("Received message from {$topic}: {$payload} ");
        });
        $mqtt->loop(true, true);

    }
}
