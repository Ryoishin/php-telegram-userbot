<?php 

/**
 * @var danog\MadelineProto\API $bot
 * @var array $update
 * @var string|null $message
 * @var int|null $userId
 * @var int|null $fromId
 */

if (mb_strtolower($message) == '.ping') {
    edit('<b>pong!</b>');
}