# PHP Telegram Userbot

PHP Telegram userbot based on [MadelineProto](https://docs.madelineproto.xyz/) library.

# Install
Clone this repository:
```bash
git clone https://github.com/aethletic/php-telegram-userbot.git userbot
```

Go to downloaded folder:
```bash
cd userbot
```

Rename `settings.php.example` to `settings.php`
```bash
cp .settings.php.example .settings.php
```

Run userbot:
```bash
php userbot.php
```

Now, you need to go through authorization. 

The first time authorization will take a long time, but the next times it will be faster.

See [MadelineProto](https://docs.madelineproto.xyz/) docs [here](https://docs.madelineproto.xyz/).

# Components
All your code should be in the `components` folder.

Every time a new `$update` arrives, all components are loaded anew. 

That is, you can launch the userbot once and change the component code on the fly without fear of errors that the userbot will not crash.

For example, you can see `ping` component [here](https://github.com/aethletic/php-telegram-userbot/tree/master/components/ping).

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
 * @var danog\MadelineProto\API $bot
 * @var array $update
 * @var string|null $message
 * @var int|null $userId
 * @var int|null $fromId
 */

if ($message == '.helloworld' && $fromId == 'YOUR_TELEGRAM_ID') {
    edit('<b>Hello World!</b>');
}
```

# Helpers

`send($text, $extra)` - short alias for `$bot->messages->sendMessage()`.

`edit($text, $extra)` - short alias for `$bot->messages->editMessage()`.

> **NOTE:** You can pass method params in `$extra`.








