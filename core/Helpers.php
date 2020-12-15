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
    function edit($text, $extra = [])
    {
        $userbot = Userbot::getInstance();
        $bot = $userbot->bot;
        $update = $userbot->update;
        return $bot->messages->editMessage(array_merge([
            'id' => @$update['message']['id'],
            'peer' => $update,
            'message' => $text,
            'parse_mode' => 'html',
        ], $extra));
    }
}

if (!function_exists('send')) {
    function send($text, $extra = [])
    {
        $userbot = Userbot::getInstance();
        $bot = $userbot->bot;
        $update = $userbot->update;
        return $bot->messages->sendMessage(array_merge([
            'peer' => $update,
            'message' => $text,
            'parse_mode' => 'html',
        ],  $extra));
    }
}

if (!function_exists('reply')) {
    function reply($text, $extra = [])
    {
        $userbot = Userbot::getInstance();
        $bot = $userbot->bot;
        $update = $userbot->update;
        return $bot->messages->sendMessage(array_merge([
            'peer' => $update,
            'reply_to_msg_id' => $update['message']['id'],
            'message' => $text,
            'parse_mode' => 'html',
        ], $extra));
    }
}

if (!function_exists('sendMedia')) {
    function sendMedia($media, $text = null, $extra = [])
    {
        $userbot = Userbot::getInstance();
        $bot = $userbot->bot;
        $update = $userbot->update;
        return $bot->messages->sendMedia(array_merge([
            'peer' => $update,
            'media' => [
                '_' => 'inputMediaUploadedDocument',
                'file' => $media,
                'attributes' => [['_' => 'documentAttributeFilename', 'file_name' => basename($media)]]
            ],
            'message' => $text,
            'parse_mode' => 'html'
        ], $extra));
    }
}

if (!function_exists('replyMedia')) {
    function replyMedia($media, $text = null, $extra = [])
    {
        $userbot = Userbot::getInstance();
        $bot = $userbot->bot;
        $update = $userbot->update;
        return $bot->messages->sendMedia(array_merge([
            'peer' => $update,
            'reply_to_msg_id' => $update['message']['id'],
            'media' => [
                '_' => 'inputMediaUploadedDocument',
                'file' => $media,
                'attributes' => [['_' => 'documentAttributeFilename', 'file_name' => basename($media)]]
            ],
            'message' => $text,
            'parse_mode' => 'html'
        ], $extra));
    }
}
