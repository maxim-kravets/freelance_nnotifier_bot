<?php


namespace App\Repository;


use App\Entity\Subscription;

interface SubscriptionRepositoryInterface
{
    public function getSubscriptionByUserTelegramId(int $id): ?Subscription;
    public function save(Subscription $entity): void;
}