<?php


namespace App\Service;


use Telegram\Bot\Api;

interface TelegramInterface
{
    public function getApi(): Api;
}