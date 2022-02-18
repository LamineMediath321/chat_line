<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    // /**
    //  * @return Message[] Returns an array of Message objects
    //  */
    public function findAllDiscuss(int $user_1,int $user_2)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('SELECT m
                        FROM App\Entity\Message m 
                        WHERE (m.emmeteur = :user_1 AND m.recepteur = :user_2)
                        or(m.emmeteur = :user_2 AND m.recepteur = :user_1)'
        );
        $query->setParameters(array(
            'user_1' => $user_1,
            'user_2' => $user_2,
        ));
        return $query->getResult(); // array of ForumUser objects
        /*return $this->createQueryBuilder('m')
            ->andWhere('m.emmeteur=?1')
            ->andWhere('m.recepteur=?2')
            ->orWhere('m.emmeteur=?2')
            ->orWhere('m.recepteur=?1')
            ->setParameter('1', $user_1)
            ->setParameter('2',$user_2)
            ->orderBy('m.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;*/
    }

    /*
    public function findOneBySomeField($value): ?Message
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
