<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route("/inscription", name: "inscription", methods: ["GET", 'POST'])]
    function inscription(Request $req)
    {
        // instancier un objet a lier avec le formulaire 
        $user = new User();
        // Creation du formulaire a partir de la classe InscriptionForm en le liant avec l'objet $user
        $inscriptionForm = $this->createForm(InscriptionForm::class, $user);

        // Récuperer les données du corp de la requête handleRequest et isSubmitted nous viens de abstractType qu'on utilise dans la class InscriptionForm grace à l'extends AbstractType
        $inscriptionForm->handleRequest($req);

        // Tester si le formulaire est valide
        if ($inscriptionForm->isSubmitted()&& $inscriptionForm->isValid()) {
            // l'objet user sera automaitiquement iriguer (alimenté, initialisé) avec les données du formulaire
            dump('Formulaire Soumis');
        }

        // Retourner la vue avec le formulaire
        return $this->render(
            'inscription.html.twig',
            ['formulaire' => $inscriptionForm->createView()]
        );
    }
}
