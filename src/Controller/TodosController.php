<?php

namespace App\Controller;

use App\Entity\Taches;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TodosController extends AbstractController
{
    #[Route("/todos", name: "todo", methods: ["GET"])]
    function contact()
    {
        return $this->render('todos.html.twig');
    }

    #[Route("/todos/traitement", name: "todos.traitement", methods: ["POST"])]
    function addList(Request $req, MessageRepository $repo)
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

        return $this->render('todos.html.twig',['sucess' =>true, 'nom' => "donnée envoyé"]
    );
    }
}
