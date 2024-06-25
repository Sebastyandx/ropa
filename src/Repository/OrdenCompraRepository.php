<?php

namespace App\Repository;

use App\Entity\OrdenCompra;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

/**
 * @extends ServiceEntityRepository<OrdenCompra>
 */
class OrdenCompraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrdenCompra::class);
    }

    //    /**
    //     * @return OrdenCompra[] Returns an array of OrdenCompra objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?OrdenCompra
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function traerOrdenCompras($id){
        return $this->createQueryBuilder('o')->where('o.user = :id')->setParameter('id',$id)->getQuery()->getResult();
    }
}
