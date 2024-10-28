<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\MatiereForm;
use App\Repository\NoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NotesController extends AbstractController
{
    #[Route("/notes", name: "notes", methods: ["GET", "POST"])]
    function pageNotes(NoteRepository $repo, Request $req)
    {
        $note = new Note();
        $matiereForm = $this->createForm(MatiereForm::class, $note);

        $matiereForm->handleRequest($req);
        if ($matiereForm->isSubmitted() && $matiereForm->isValid()) {
            $repo->sauvegarder($note, true);
        }

        return $this->render('notes.html.twig', ['formulaire' => $matiereForm]);
    }
}

// Exercice:
// 1. Créer une classe pour le formulaire: MatieresForm
// 2. Ajouter des champs: nom complet, matiere, note
// 3. Utiliser afficher le formulaire dans le controller et la vue