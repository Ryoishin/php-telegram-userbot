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
        $me = $this->bot->getSelf();
        while (true) {
            $this->bot->setCallback(function ($update) use ($me) {
                /** ignore everything except messages */
                if (!isset($update['message']['message'])) {
                    return;
                }

                /** ignore old updates if bot was down some time */
                if (round(time() - $update['message']['date']) > 60) {
                    return;
                }

                /** print update in terminal */
                if ($this->settings['print_update'] ?? false) {
                    print_r($update);
                } 

                $this->update = $update;

                /** laod and run components */
                $this->loadComponents($this->bot, $update, @$update['message']['message'], $me, @$update['message']['user_id'], @$update['message']['from_id']);
            });
            
            $this->bot->async(true);
            $this->bot->loop();
        }
    }

    private function loadComponents(API $bot, array $update, $message = null, array $me, $userId = null, $fromId = null)
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
