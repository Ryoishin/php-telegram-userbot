<?php 

/**
 * @var danog\MadelineProto\API $bot
 * @var array $update
 * @var string|null $message
 * @var array $me
 * @var int|null $userId
 * @var int|null $fromId
 */

 $fileHeader = "<?php 

 /**
  * Generated from `cp` component.
  */  
 
 /**
  * @var danog\MadelineProto\API \$bot
  * @var array \$update
  * @var string|null \$message
  * @var array \$me
  * @var int|null \$userId
  * @var int|null \$fromId
  */";

if (mb_strtolower(mb_substr($message, 0, 4)) == '.cp ' && $me['id'] == $fromId) {
    $cmd = explode("\n", $message);
    $cmd = is_array($cmd) ? $cmd[0] : $cmd;
    $cmd = explode(' ', $cmd);
    
    switch ($cmd[1]) {
        case 'del':
            $dir = __DIR__ . "/../{$cmd[2]}";

            if (!file_exists($dir)) {
                return reply("Component <b>{$cmd[2]}</b> not exists.");
            }

            try {
                if (file_exists("{$dir}/component.php")) {
                    unlink("{$dir}/component.php");
                }
                rmdir($dir);
                reply("Component successfully deleted!");
            } catch (\Throwable $th) {
                reply($th->getMessage());
            }
            break;

        case 'new':
            $dir = __DIR__ . "/../{$cmd[2]}";

            if (file_exists($dir)) {
                return reply("Component <b>{$cmd[2]}</b> already exists.");
            }

            mkdir($dir, 0750);

            $file = "{$dir}/component.php";

            file_put_contents($file, $fileHeader);
            
            reply("Component successfully created!");

            break;

        case 'show':
            $file = __DIR__ . "/../{$cmd[2]}/component.php";

            if (!file_exists($file)) {
                return reply("Component <b>{$cmd[2]}</b> not exists.");
            }

            replyMedia($file, "<code>" . end($cmd) . "</code>");

            break;

        case 'save':
            $dir = __DIR__ . "/../{$cmd[2]}";

            if (!file_exists($dir)) {
                return reply("Component <b>{$cmd[2]}</b> not exists, create component first.");
            }

            $file = "{$dir}/component.php";

            if (!file_exists($file)) {
                unlink($file);
            }

            $bot->downloadToFile($update['message']['media'], $file);

            reply("Component successfuly saved!");

            break;
        
        case 'list':
            $list = array_map(fn($item) => '<code>' . basename($item) . '</code>', glob(__DIR__ . '/../*'));
            reply(implode("\n", $list));
            break;

        case 'set':
            $dir = __DIR__ . "/../{$cmd[2]}";

            if (!file_exists($dir)) {
                return reply("Component <b>{$cmd[2]}</b> not exists, create component first.");
            }

            $file = "{$dir}/component.php";

            $code = explode("\n", $message);
            unset($code[0]);
            $code = implode("\n", $code);

            file_put_contents($file, "{$fileHeader}

{$code}");

            send("Component successfully updated!");

            break;
        
        case 'help':
            $msg  = "List of commands:\n";
            $msg .= "<code>.cp new {component}</code>\n";
            $msg .= "<code>.cp del {component}</code>\n";
            $msg .= "<code>.cp set {component} {code}</code>\n";
            $msg .= "<code>.cp save {component} + file</code>\n";
            $msg .= "<code>.cp show {component}</code>\n";
            $msg .= "<code>.cp list</code>\n";
            $msg .= "<code>.cp help</code>\n";
            reply($msg);
            break;
        
        default:
            reply('This command not exists.');
            break;
    }
}