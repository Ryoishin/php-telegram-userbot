<?php

if (!function_exists('bot')) {
    function bot()
    {
        return Userbot::getInstance()->bot;
    }
}

if (!function_exists('update')) {
    function update()
    {
        return Userbot::getInstance()->update;
    }
}

if (!function_exists('edit')) {
    function edit($text)
    {
        $userbot = Userbot::getInstance();
        $bot = $userbot->bot;
        $update = $userbot->update;
        return $bot->messages->editMessage([
            'id' => @$update['message']['id'],
            'peer' => $update,
            'message' => $text,
            'parse_mode' => 'html',
        ]);
    }
}

if (!function_exists('send')) {
    function send($text)
    {
        $userbot = Userbot::getInstance();
        $bot = $userbot->bot;
        $update = $userbot->update;
        return $bot->messages->sendMessage([
            'peer' => $update,
            'message' => $text,
            'parse_mode' => 'html',
        ]);
    }
}
