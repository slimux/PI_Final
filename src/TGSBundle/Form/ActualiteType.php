<?php

namespace TGSBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ActualiteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',\Symfony\Component\Form\Extension\Core\Type\TextType::class)
            ->add('dateHeureCreation',\Symfony\Component\Form\Extension\Core\Type\DateType::class)
            ->add('image',MediaActuType::class)
            ->add('description',\Symfony\Component\Form\Extension\Core\Type\TextType::class)
            ->add('type',\Symfony\Component\Form\Extension\Core\Type\TextType::class)
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TGSBundle\Entity\Actualite'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tgsbundle_actualite';
    }
}
