<?php

namespace MyApp\VideoBundle\Form;


use DateTime;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre')
                ->add('dateAjout', DateTimeType::class, array('data' => new DateTime('now')))
    ->add('description', CKEditorType::class, array(
        'config' => array(
            'uiColor' => '#ffffff',)))

            ->add('typeVideo', ChoiceType::class, array('choices'=> array('Trailer'=>'Trailer','Review'=>'Review','GamePlay'=>'GamePlay')))
            ->add('codeVideo')
        ->add('nbVue');


    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\VideoBundle\Entity\Video'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myapp_videobundle_video';
    }


}
