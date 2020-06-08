<?php

namespace App\Controller;

use App\Dto\Subscription as SubscriptionDto;
use App\Entity\Subscription;
use App\Repository\SubscriptionRepositoryInterface;
use App\Service\TelegramInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private $subscriptionRepository;
    private $telegramService;

    public function __construct(
        SubscriptionRepositoryInterface $subscriptionRepository,
        TelegramInterface $telegramService
    ) {
        $this->subscriptionRepository = $subscriptionRepository;
        $this->telegramService = $telegramService;
    }

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $result = $this->telegramService->getApi()->getWebhookUpdates();

        $text = $result['message']['text'];
        $chat_id = $result['message']['chat']['id'];
        $user_id = $result['message']['from']['id'];

        $subscription = $this->subscriptionRepository->getSubscriptionByUserTelegramId($user_id);

        if (empty($subscription)) {
            $subscriptionDto = new SubscriptionDto($user_id, false);
            $subscription = Subscription::create($subscriptionDto);
            $this->subscriptionRepository->save($subscription);
        }

        switch ($text) {
            case '/subscribe':
                $reply = 'You are successfully subscribed';
                $subscription->setStatus(true);
                $this->subscriptionRepository->save($subscription);
                $this->telegramService->getApi()->sendMessage(['chat_id' => $chat_id, 'text' => $reply]);
                break;
            case '/unsubscribe':
                $reply = 'You are successfully unsubscribed';
                $subscription->setStatus(false);
                $this->subscriptionRepository->save($subscription);
                $this->telegramService->getApi()->sendMessage(['chat_id' => $chat_id, 'text' => $reply]);
                break;
        }

        return new Response('success');
    }
}
