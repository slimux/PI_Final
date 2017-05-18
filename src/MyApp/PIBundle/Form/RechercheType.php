<?php
namespace MyApp\PIBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('recherche',TextType::class, array('label' => false,'attr' => array('class' => 'input-medium search-query')));
    }
    public function getBlockPrefix()
    {
        return 'my_app_pibundlex';
    }
    public function getName()
    {
        return 'myapp_pibundle_recherche';
    }
}