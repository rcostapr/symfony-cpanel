<?php

namespace App\Repository;

use App\Entity\Module;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Module::class);
    }

    public function save(Module $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Module $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllOrderedByMenuOrder(?int $menuid): array
    {

        // root menu items
        if (!$menuid) {
            return $this->createQueryBuilder('m')
                ->orderBy('m.menuorder', 'ASC')
                ->andWhere('m.menuid IS NULL')
                ->getQuery()
                ->getResult();
        }

        // child menu items
        return $this->createQueryBuilder('m')
            ->orderBy('m.menuorder', 'ASC')
            ->andWhere('m.menuid = :menuid')
            ->orWhere('m.id = :id')
            ->setParameter('menuid', $menuid)
            ->setParameter('id', $menuid)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Module[] Returns an array of Module objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    public function findOneByName(string $name): ?Module
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
