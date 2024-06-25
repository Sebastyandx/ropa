<?php

namespace App\Repository;

use App\Entity\Productos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Productos>
 */
class ProductosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Productos::class);
    }

    //    /**
    //     * @return Productos[] Returns an array of Productos objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }
    public function traer6productos(){
        return $this->createQueryBuilder('p')
        ->setMaxResults(6)
        ->getQuery()
        ->getResult();
    }

    public function findAll15(){
        return $this->createQueryBuilder('p')
        ->setMaxResults(15)
        ->getQuery()
        ->getResult();
    }
    //    public function findOneBySomeField($value): ?Productos
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

/*     public function traerProductoEspecificos(){
        return $this->createQueryBuilder('p')
        ->where('p.id = 1')
        ->getQuery()
        ->getResult();
    }
 */
    
/*     public function postUser($id){
        return $this->getEntityManager()
        ->createQuery(
            'SELECT productos.id, productos.nombre, productos.precio, productos.descripcion, productos.stock, productos.imagen from App\Entity\Productos productos INNER JOIN App\Entity\Imagen imagen ON imagen.producto_id = producto.id WHERE  post.User =:id'
        )
        ->setParameter('id',$id)
        ->getResult();        
    } */
    public function traerRopa($id){
    return $this->createQueryBuilder('p')
        ->leftJoin('p.imagens', 'i')
        ->where('i.id = :id')
        ->setParameter('id',$id)
        ->getQuery()
        ->getResult();
    }

    public function traerRopaCarrito($id){
        return $this->createQueryBuilder('p')
            ->where('p.id = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getResult();
        }

}
