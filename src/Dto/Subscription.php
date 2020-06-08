<?php


namespace App\Dto;


class Subscription
{
    private $telegram_user_id;
    private $status;

    public function __construct(int $telegram_user_id, bool $status = false)
    {
        $this->telegram_user_id = $telegram_user_id;
        $this->status = $status;
    }

    public function getTelegramUserId(): int
    {
        return $this->telegram_user_id;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }
}
