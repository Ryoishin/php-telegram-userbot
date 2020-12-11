<?php 

/**
 * @var danog\MadelineProto\API $bot
 * @var array $update
 * @var string|null $message
 * @var array $me
 * @var int|null $userId
 * @var int|null $fromId
 */
print_r($me);
if (mb_strtolower($message) == '.ping' && $me['id'] == $fromId) {
    edit('<b>pong!</b>');
}