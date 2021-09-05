<?php

if (!file_exists(__DIR__ . '/madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', __DIR__ . '/madeline.php');
}

require __DIR__ . '/autoload.php';

$maxCountFails = 10;

$fails = 0;
while (true) {
    try {
        Userbot::getInstance()
                ->create(__DIR__ . '/storage/sessions/userbot.ssn', require __DIR__ . '/settings.php')
                ->run();
    } catch (\Throwable $th) {
        file_put_contents(__DIR__ . '/fails.php', "\n---------------\n" . $th->getMessage() . "\n", FILE_APPEND);
    }

    if (++$fails >= $maxCountFails) break;

    echo "\n-------------------------------\n";
    echo "Whoops! Userbot Down, Restarting ...\n";
    echo "\n-------------------------------\n";
}

echo "Userbot Was Stopped.";
