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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AstuceAddForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title_astuce')
            ->add('description_astuce', TextareaType::class)
            ->add('image_astuce', FileType::class , array('data_class' => null)
            )
            ->add('jeu', EntityType::class, array(
                'class' => 'EspritGameBundle:jeu',
                'choice_label' => 'titre',
                'multiple' => false,
            ))
            ->setMethod('GET')
            ->add('Ajouter',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'esprit_game_bundle_astuce_add_form';
    }
}
