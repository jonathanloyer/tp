<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class InscriptionForm extends AbstractType
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
                'nom',
                TextType::class,
                ["label" => "Nom de famille", 'attr' => ['placeholder' => 'Entrez vôtre nom'],
                "constraints" => [
                    new Assert\NotBlank(['message'=> 'Nom obligatoire']),
                    new Assert\Length(
                        [
                            "min"=> 2,
                            "max"=> 255,
                            'minMessage' => "Le nom est trop court",
                            'maxMessage' => "Le nom est trop long"

                        ]
                    )
                ]]
            )
            ->add(
                'prenom',
                TextType::class,
                ['attr' => ['placeholder' => 'Entrez vôtre prénom'],"constraints" => [
                    new Assert\NotBlank(['message'=> 'Nom obligatoire']),
                    new Assert\Length(
                        [
                            "min"=> 2,
                            "max"=> 255,
                            'minMessage' => "Le nom est trop court",
                            'maxMessage' => "Le nom est trop long"
                        ]
                    )

                        ]]
            )

            ->add(
                'genre',
                ChoiceType::class,
                ['choices' => ['Masculin' => 'm', 'Feminin' => 'f']]
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
