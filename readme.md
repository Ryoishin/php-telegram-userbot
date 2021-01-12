# PHP Telegram Userbot

PHP Telegram userbot based on [MadelineProto](https://docs.madelineproto.xyz/) library.

# Install
**1.** Clone this repository:
```bash
git clone https://github.com/chipslays/php-telegram-userbot.git userbot
```

**2.** Go to downloaded folder:
```bash
cd userbot
```

**3.** Rename `settings.php.example` to `settings.php`. 

See more info about settings [here](https://docs.madelineproto.xyz/docs/SETTINGS.html).
```bash
cp settings.php.example settings.php
```

**4.** In `settings.php` you can may change `api_id` and `api_hash` (optional).
```
...
'app_info' => [
    'api_id' => 'YOUR_API_ID',
    'api_hash' => 'YOUR_API_HASH',
],
...
```

**5.** Run userbot:
```bash
php userbot.php
```

Now, you need to go through authorization. 

The first time authorization will take a long time, but the next times it will be faster.

See [MadelineProto](https://docs.madelineproto.xyz/) docs [here](https://docs.madelineproto.xyz/).

# Components
All your code should be in the `components` folder.

Every time a new `$update` arrives, all components are loaded anew. 

That is, you can launch the userbot once and change the component code on the fly without fear of errors that the userbot will crash.

For example, you can see `ping` component [here](https://github.com/chipslays/php-telegram-userbot/tree/master/components/ping).

### Create new component

First, create new folder for your component:
```bash
mkdir components/helloworld
```

Create entrypoint file `component.php` in `components/helloworld` folder:
```bash
touch components/helloworld/component.php
```

Now, create component logic:
```php
<?php 

/**
 * @var danog\MadelineProto\API $bot MadelineProto API Instance
 * @var array $update Array of come Update
 * @var string|null $message Text of come message
 * @var array $me Info about your profile
 * @var int|null $userId Interlocutor (chat, etc.)
 * @var int|null $fromId Where is it sent from
 */

if ($message == '.helloworld' && $me['id'] == $fromId) {
    edit('<b>Hello World!</b>');
}
```

Now, we can send a message with the text `.helloworld`, and it will be automatically edited to contain `Hello World!`.

> **NOTE:** After editing or creating a new component, it is **not necessary** to restart the userbot.

# Helpers

> **NOTE:** You can pass any method params in `$extra`.

`send($text, [$extra = []])` - short alias for `$bot->messages->sendMessage()`.

`reply($text, [$extra = []])` - reply to incoming message.

`edit($text, [$extra = []])` - short alias for `$bot->messages->editMessage()`.

`sendMedia($media, [$text = null, $extra = []])` - short alias for `$bot->messages->sendMedia`.

`replyMedia($media, [$text = null, $extra = []])` - reply with file to incoming message.










