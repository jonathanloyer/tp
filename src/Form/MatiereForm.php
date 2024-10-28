<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class MatiereForm extends AbstractType
{

    function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setMethod('POST');
        $builder
            ->add(
                'fullName',
                TextType::class,
                ['attr' => ['placeholder' => "Entrez votre nom"], "constraints" => [
                    new Assert\NotBlank(['message' => 'Nom obligatoire!'])
                ]]
            )
            ->add(
                'matiere',
                ChoiceType::class,
                ['choices' => ['math' => "math", 'info' => "info", 'physique' => 'physique']]
            )
            ->add(
                'note',
                NumberType::class,
                ['attr' => ['placeholder' => "Entrez votre nom"], "constraints" => [
                    new Assert\NotBlank(['message' => 'Note obligatoire!'])
                ]]
            )
            ->add("Envoyer", SubmitType::class, ["attr" => ['class' => "button"]]);
    }
}
