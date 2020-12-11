<?php

use danog\MadelineProto\API;

class Userbot
{
    /**
     * @var API
     */
    public $bot;

    public $update;
    public $settings;

    private static ?Userbot $instance = null;

    public function create($session, $settings)
    {
        $this->settings = $settings;
        $this->bot = new API($session, $settings);
        $this->bot->async(false);
        $this->bot->start();

        return $this;
    }

    public function run()
    {
        while (true) {
            $this->bot->setCallback(function ($update) {
                if ($this->settings['print_update'] ?? false) {
                    print_r($update);
                } 
                $this->update = $update;
                $this->loadComponents($this->bot, $update, @$update['message']['message'], @$update['message']['user_id'], @$update['message']['from_id']);
            });
            $this->bot->async(true);
            $this->bot->loop();
        }
    }

    private function loadComponents(API $bot, array $update, $message = null, $userId = null, $fromId = null)
    {
        foreach (glob(__DIR__ . '/../components/*/component.php') as $component) {
            try {
                include $component;
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        }
    }

    public static function getInstance(): Userbot
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    private function __construct()
    {
    }

    private function __wakeup()
    {
    }

    private function __clone()
    {
    }
}
