<?php

namespace App\Repository;

use App\Entity\Subscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Subscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subscription[]    findAll()
 * @method Subscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubscriptionRepository extends ServiceEntityRepository implements SubscriptionRepositoryInterface
{
    private $em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subscription::class);
        $this->em = $this->getEntityManager();
    }

    public function getSubscriptionByUserTelegramId(int $id): ?Subscription
    {
        return $this->findOneBy(['telegram_user_id' => $id]);
    }

    public function save(Subscription $entity): void
    {
        try {
            $this->em->persist($entity);
            $this->em->flush();
        } catch (ORMException $e) {};
    }
}
