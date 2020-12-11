<?php 

/**
 * @var danog\MadelineProto\API $bot
 * @var array $update
 * @var string|null $message
 * @var int|null $userId
 * @var int|null $fromId
 */

if (mb_strtolower(mb_substr($message, 0, 5)) == '.eval') {
    try {
        $php = trim(str_ireplace('.eval', '', $message));
        $eval = print_r(eval($php), true);
        
        if (mb_strlen($eval) > 4000) {
            $msgs = str_split($eval, 4000);
            edit("<b>code:</b> <code>{$php}</code>\n<b>output:</b> " . array_shift($msgs));
            foreach ($msgs as $key => $value) {
                send($value);
            }
        } else {
            edit("<b>code:</b> <code>{$php}</code>\n<b>output:</b> {$eval}");
        }
    } catch (\Throwable $th) {
        edit("<b>Whoops!</b>\n<code>" . $th->getMessage() . "</code>");
    }
}