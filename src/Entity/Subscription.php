<?php

namespace App\Entity;

use App\Repository\SubscriptionRepository;
use App\Dto\Subscription as SubscriptionDto;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubscriptionRepository::class)
 */
class Subscription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $telegram_user_id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTelegramUserId(): ?int
    {
        return $this->telegram_user_id;
    }

    public function setTelegramUserId(int $telegram_user_id): self
    {
        $this->telegram_user_id = $telegram_user_id;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public static function create(SubscriptionDto $subscriptionDto): self
    {
        $subscription = new Subscription();
        $subscription->setTelegramUserId($subscriptionDto->getTelegramUserId());
        $subscription->setStatus($subscriptionDto->getStatus());

        return $subscription;
    }
}
