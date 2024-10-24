<?php

namespace App\Repository;

use App\Entity\ListTaches;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ListTachesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, ListTaches::class);
    }

    // Methode pour enregistrer un Message dans la BDD
    public function sauvegarder(ListTaches $nouvelleListe, ?bool $isSave)
    {
        // Créer la requete SQL
        $this->getEntityManager()->persist($nouvelleListe);
        if ($isSave) {
            // Execute la requete
            $this->getEntityManager()->flush();
        }
        return $nouvelleListe;
    }

    function supprimer(ListTaches $listTaches)
    {
        $this->getEntityManager()->remove($listTaches);
        $this->getEntityManager()->flush();
    }
}