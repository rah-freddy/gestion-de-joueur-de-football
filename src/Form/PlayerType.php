<?php

namespace App\Form;

use App\Entity\ClubTeam;
use App\Entity\NationalTeam;
use App\Entity\Player;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('birthDate', DateType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'
            ])
            ->add('nationality', TextType::class, [
                'label' => 'Nationalité'
            ])
            ->add('course', TextareaType::class, [
                'label' => 'Parcours'
            ])
            ->add('goalsNumber', NumberType::class, [
                'label' => 'Nombre de buts',
                'html5' => true,
                'attr' => [
                    'inputmode' => 'numeric',
                    'pattern' => '[0-9]*'
                ]
            ])
            ->add('clubTeam', EntityType::class, [
                'class' => ClubTeam::class,
                'label' => 'Nom de l\'équipe',
                'placeholder' => 'Choisissez une équipe (club)',
                'choice_label' => function (ClubTeam $clubTeam) {
                    return $clubTeam->getName();
                }
            ])
            ->add('nationalTeam', EntityType::class, [
                'class' => NationalTeam::class,
                'label' => 'Nom de l\'équipe nationale',
                'placeholder' => 'Choisissez une équipe nationale',
                'choice_label' => function (NationalTeam $nationalTeam) {
                    return $nationalTeam->getName();
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
