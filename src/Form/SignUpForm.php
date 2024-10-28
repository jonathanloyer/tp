<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class SignUpForm extends AbstractType
{
    function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setMethod('POST');
        $builder->setAttributes(['class' => "MonId"]);

        $builder
            ->add(
                'email',
                EmailType::class,
                ['attr' => ['placeholder' => 'Entrez vôtre email'], "constraints" => [
                    new Assert\Email(['message'=> 'Email invalide!'])
                ]]
            )

            ->add(
                'password',
                PasswordType::class,
                ["label" => "mot de passe ", 'attr' => ['placeholder' => 'Entrez vôtre mot de passe'],
                "constraints" => [
                    new Assert\NotBlank(['message'=> 'mot de passe obligatoire']),
                    new Assert\Length(
                        [
                            "min"=> 6,
                            "max"=> 255,
                            'minMessage' => "Le mot de passe est trop court",
                            'maxMessage' => "Le mot de passe est trop long"

                        ]
                    )
                ]]
            )
            

            ->add(
                'Envoyer',
                SubmitType::class,
                ["attr" => ['class' => "button"]]
            );
            // ça permet de ne pas etre obligé de remplir les champs nom et prenom 
            // $builder->get('nom')->setRequired(false);
            // $builder->get('prenom')->setRequired(false);

    }
}
