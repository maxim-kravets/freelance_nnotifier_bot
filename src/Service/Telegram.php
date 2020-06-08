<?php


namespace App\Service;


use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;

class Telegram implements TelegramInterface
{
    private $api;

    public function __construct(?string $token)
    {
        if (empty($token)) {
            throw new \LogicException('TELEGRAM_BOT_TOKEN can\'t be empty. Please, fill it in .env.local');
        }

        try {
            $this->api = new Api($token);
        } catch (TelegramSDKException $e) {};
    }

    public function getApi(): Api
    {
        return $this->api;
    }
}