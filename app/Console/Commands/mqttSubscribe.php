<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class mqttSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:subscribe {topic}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to a given MQTT topic and display messages in the terminal';

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
        $topic = $this->argument('topic');

        $mqtt = MQTT::connection();

        $this->info("Subscribing to topic: {$topic}");

        $mqtt->subscribe($topic, function (string $topic, string $message) {
            $this->info(sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message));
            // A1-2-1231231
            // split
            // id = A1
            // value = 2
            // time = 1231231

        }, 1);

        $mqtt->loop(true);

        return Command::SUCCESS;
    }
}
