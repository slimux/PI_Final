<?php

namespace MyApp\PIBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Intl\Intl;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ServeurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        \Locale::setDefault('en');
        $countries = Intl::getRegionBundle()->getCountryNames();
        $builder->add('nom',null, array('label' => 'Nom','attr' => array('class' => 'form-control')))
            ->add('location',ChoiceType::class, array('choices' => $countries,'label' => 'Location','attr' => array('class' => 'form-control')))
            ->add('typeJeu',null, array('label' => 'Type Jeu','attr' => array('class' => 'form-control')))
            ->add('rank',null, array('label' => 'Rank','attr' => array('class' => 'form-control')))
            ->add('ip',null, array('label' => 'IP:Port','attr' => array('class' => 'form-control')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\PIBundle\Entity\Serveur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myapp_pibundle_serveur';
    }


}
