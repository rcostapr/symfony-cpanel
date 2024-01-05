<?php

namespace App\Repository;

use App\Entity\Transcription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Transcription>
 *
 * @method Transcription|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transcription|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transcription[]    findAll()
 * @method Transcription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TranscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transcription::class);
    }

//    /**
//     * @return Transcription[] Returns an array of Transcription objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Transcription
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
