<?php

namespace App\Controller;

use App\Entity\ListTaches;
use App\Entity\Taches;
use App\Repository\ListTachesRepository;
use App\Repository\TachesRepository;
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
    #[Route("/taches/create", name: "taches.create", methods: ["POST"])]
    function createListeTaches(Request $req, ListTachesRepository $repo)
    {

        // Récuperer les donnée de la requete
        $nomListe = $req->request->get('nom');

        $nouvelleListeTaches = new ListTaches();
        $nouvelleListeTaches->setTitle($nomListe);
        $nouvelleListeTaches->setDate(new DateTime());
        $repo->sauvegarder($nouvelleListeTaches, true);

        return $this->redirectToRoute("taches");
    }
    #[Route("/taches/create/{list_id}", name: "tache.create", methods: ["POST"])]
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
    #[Route("/taches/delete/{list_id}", name: "tache.delete", methods: ["GET"])]
    function supprimerTaches($list_id, ListTachesRepository $repo)
    {
        $listTache = $repo->find($list_id);

        $repo->supprimer($listTache);

        return $this->redirectToRoute('taches');
    }

    #[Route("/taches/finish/{tache_id}", name: "tache.finish", methods: ["GET"])]
    function termineTache($tache_id, TachesRepository $repo)
    {
        // Récupérer la tache depuis la DB en utilisant
        $tache = $repo->find($tache_id);

        // Vérifiez si elle exiiste
        if (!$tache) {
            return $this->redirectToRoute('taches');
        }

        // Toggle: Inverseur de boolean
        $tache->setIsFinished(!$tache->isFinished() );
        // $tache->setIsFinished(!$tache->isFinished()); ce qui veut dire que $tache prend la methode isFinished dans entity/Taches puis en paramétre !true qui donnera false et si !false nous donnera true.


        // Enregistrer la tache dans la DB
        $repo->sauvegarder($tache, true);

        // Rediriger vers la page todo list
        return $this->redirectToRoute('taches');
    }

    // Exercice:
    // 1. Afficher les tache non términée en rouge, et le tache terminée en vert.

    // 2. Ajouter un bouton pour terminée/ou remettre une tache.
}

// Entity: Representation De la table de la DB
// Repository:Méthodes qui Permettent d'interagir avec la BD