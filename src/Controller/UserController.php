<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignUpForm;
use App\Repository\UserRepository;
use PhpParser\Node\Stmt\Return_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route("/inscription", name: "inscription", methods: ["GET", 'POST'])]

    function inscription(Request $req, UserPasswordHasherInterface $passwordHasher, UserRepository $repo)
    {
        // Rediriger l'utilisateur vers la page de profil si il est connecté IS_AUTHENTICATED_FULLY est un role native de symfony
        if($this->isGranted(('IS_AUTHENTICATED_FULLY'))){
            return $this->redirectToRoute('profil');
        }

        // creer l'entité user
        $user = new User();


        $SignUpForm = $this->createForm(SignUpForm::class, $user);

        // utiliser la requete pour gerer le formulaire
        $SignUpForm->handleRequest($req);

        // quand le formulaire est soumis et valide
        if ($SignUpForm->isSubmitted() && $SignUpForm->isValid()) {

            // Hasher le mot de passe 
            $plainPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);

            // utiliser le repository pour enregistrer l'utilisateur dans la db
            $repo->save($user, true);
               // Redirection vers une page de succès après l'inscription
            return $this->redirectToRoute('connexion'); // Remplacez par votre route de succès
        }
          // Retourne la vue avec le formulaire
        return $this->render(
            'inscription.html.twig',
            ['formulaire' => $SignUpForm->createView()]
        );
    }

    #[Route('/connexion', name: 'connexion', methods:["get",'POST'])]
    public function connexion()
    {
        // Rediriger l'utilisateur vers la page de profil si il est connecté IS_AUTHENTICATED_FULLY est un role native de symfony
        if($this->isGranted(('IS_AUTHENTICATED_FULLY'))){
            return $this->redirectToRoute('profil');
        }

        $connexionForm = $this->createForm(SignUpForm::class);
       
        return $this->render('connexion.html.twig',['connexionForm'=> $connexionForm]);
        
    }

    #[Route('/profil', name: 'profil')]
    public function profile()
    {
        
            return $this->render('profil.html.twig');
    }
    #[Route("/admin", name: "admin", methods: ["GET", 'POST'])]
    public function admin()
    {
        // si l'utilisateur n'est pas connecté on le redirigie vers la page connexion
        if($this->isGranted('IS_AUTHENTICATED_FULLY')){
            return $this->redirectToRoute('connexion');
        }

        // si  l'utilisateur n'est pas admin on le redirige vers la page profil
        if($this->isGranted('ROLE_USER')){
            return $this->redirectToRoute('profil');
        }

        return $this->render('admin.html.twig');
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {}
}
