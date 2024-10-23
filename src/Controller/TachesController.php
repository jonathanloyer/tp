<?php

namespace App\Controller;

use App\Entity\ListTaches;
use App\Entity\Taches;
use App\Repository\ListTachesRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TachesController extends AbstractController
{
    #[Route("/taches", name: "taches", methods: ["GET"])]
    function taches(ListTachesRepository $repo)
    {
        // Récuperer toutes les liste de la DB
        $listeTache = $repo->findAll();
        // Les envoyer a la vue
        return $this->render('taches.html.twig', ['listTache' => $listeTache]);
    }

    #[Route("/tache/create/{list_id}", name: "tache.create", methods: ["POST"])]
    function createTache($list_id, ListTachesRepository $repo, Request $req)
    {
        $listTache = $repo->find($list_id);

        if (!$listTache) {
            $this->redirectToRoute('taches', ["message" => "La liste n'existe pas"]);
        }

        // Créer la tache
        $nouvelTache = new Taches();
        // Nommer la tache
        $nouvelTache->setTitle($req->request->get('titre'));

        // Ajouter la tache a la liste
        $listTache->ajouteTache($nouvelTache);
        // Enregistrer la liste
        $repo->sauvegarder($listTache, true);

        return $this->redirectToRoute('taches');
    }
}

// Entity: Representation De la table de la DB
// Repository:Méthodes qui Permettent d'interagir avec la BD