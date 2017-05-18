<?php

namespace MyApp\PIBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
class ProduitsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',null, array('label' => 'Nom','attr' => array('class' => 'form-control')))
                ->add('description',CKEditorType::class, array('config' => array('uiColor' => '#ffffff')))
                ->add('prix',null, array('label' => 'Prix','attr' => array('class' => 'form-control')))
                ->add('disponible',null, array('label' => 'Disponible','attr' => array('class' => 'form-control')))
                ->add('image', MediaType::class)
                ->add('categorie',null, array('label' => 'Categorie','attr' => array('class' => 'form-control')))
                ->add('tva',null, array('label' => 'TVA','attr' => array('class' => 'form-control')))
                ->add('note_presse',null, array('label' => 'Note Presse','attr' => array('class' => 'form-control')))
                ->add('note_globale',null, array('label' => 'Note Globale','attr' => array('class' => 'form-control')))
                ->add('video',null, array('label' => 'URL Youtube','attr' => array('class' => 'form-control')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\PIBundle\Entity\Produits'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myapp_pibundle_produits';
    }


}
