<?php

namespace App\Controller;

use App\Entity\Taches;
use App\Repository\MessageRepository;
use App\Repository\TachesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodosController extends AbstractController
{
    #[Route("/todos", name: "todo", methods: ["GET"])]
    function contact(TachesRepository $repo)
    {
        // Récupérer toutes les tâches depuis la base de données
        $taches = $repo->findAll();
    
        // Rendre la vue avec les tâches
        return $this->render('todos.html.twig', [
            'taches' => $taches  // Passer les tâches à la vue
        ]);
    }
    #[Route("/todos/traitement", name: "todos.traitement", methods: ["POST"])]
    function addList(Request $req, TachesRepository $repo)
    {
        $nom = $req->request->get('nom');
        // dump($req->request);
        // return $this->render('todos.html.twig');

        if (!isset($nom) || $nom == "") {
            return $this->render('todos.html.twig', ['success' => false, 'nom' => "Données obligatoire!"]);
        }
        
        $newTaches = new Taches();
        $newTaches->setNom($nom);

        $repo->save($newTaches,true);

        $taches = $repo->findAll();

        return $this->render('todos.html.twig',['success' =>true, 'nom' => "donnée envoyé", 'taches'=>$taches]
    );
    }
    // src/Controller/TacheController.php



    
}



