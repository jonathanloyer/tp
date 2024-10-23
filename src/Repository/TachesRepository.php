<?php

namespace App\Repository;

use App\Entity\Taches;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TachesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, Taches::class);
    }

    public function save (Taches $newTaches, ?bool $flush = false)
    {
        $this->getEntityManager()->persist($newTaches);

        if($flush){
            $this->getEntityManager()->flush();
        }
        return $newTaches;
    }

    function delete(Taches $taches)
    {
        $this->getEntityManager()->remove($taches);
        $this->getEntityManager()->flush();
    }
}