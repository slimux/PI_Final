<?php

namespace Esprit\GameBundle\Form;


use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use blackknight467\StarRatingBundle\Form\RatingType as RatingType;


class GameUpdateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('genre')
            ->add('genre', ChoiceType::class, array(
                'choices'  => array(
                    'Aventure' => 'Aventure',
                    'Action' => 'Action',
                    'Combat' => 'Combat',
                    'Beat them all' => 'Beat them all',
                    'Plates-formes' => 'Plates-formes',
                    'Action-aventure' => 'Action-aventure',
                    'Jeu de rôle' => 'Jeu de rôle',
                ),
            ))
            ->add('date_sortie', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('note_presse')
            ->add('note_joueur')
            ->add('description', TextareaType::class)
            ->add('prix')
            ->add('console')
            ->add('console', ChoiceType::class, array(
                'choices'  => array(
                    'Ps4' => 'Ps4',
                    'Ps3' => 'Ps3',
                    'Xbox One' => 'Xbox One',
                    'Xbox 360' => 'Xbox 360',
                    'Pc' => 'Pc',
                ),
            ))
            ->add('image', FileType::class , array('data_class' => null)
            )
            ->add('developpeur')
            ->add('rating', RatingType::class, [
                'label' => 'Rating'
            ])
            ->setMethod('GET')
            ->add('Save',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'esprit_game_bundle_game_update_form';
    }
}
