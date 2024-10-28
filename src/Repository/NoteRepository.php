<?php

namespace App\Repository;

use App\Entity\Note;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class NoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, Note::class);
    }

    // Methode pour enregistrer un Message dans la BDD
    public function sauvegarder(Note $nouvelNote, ?bool $isSave)
    {
        // Créer la requete SQL
        $this->getEntityManager()->persist($nouvelNote);
        if ($isSave) {
            // Execute la requete
            $this->getEntityManager()->flush();
        }
        return $nouvelNote;
    }
}
