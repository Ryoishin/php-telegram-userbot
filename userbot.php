<?php

if (!file_exists(__DIR__ . '/madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', __DIR__ . '/madeline.php');
}

require __DIR__ . '/core/autoload.php';

$maxCountFails = 5;
$fails = 0;

while (true) {
    Userbot::getInstance()
                ->create(__DIR__ . '/storage/sessions/userbot.ssn', require __DIR__ . '/settings.php')
                ->run();

    if (++$fails >= $maxCountFails) break;

    echo "\n-------------------------------\n";
    echo "Whoops! Userbot down, restarting ...\n";
    echo "\n-------------------------------\n";
}

echo "Userbot has stopped.";
