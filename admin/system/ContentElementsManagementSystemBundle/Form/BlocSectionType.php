<?php

namespace ContentElementsManagementSystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use A2lix\TranslationFormBundle\Form\Type\TranslationsType;

class BlocSectionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('translations', TranslationsType::class,[
            'label'=>' ',
            'fields' =>[
                'title'=>[
                    'label' => 'Titre (*)',
                    'attr'=>[
                        "class" =>'form_ctrl required_class',
                        'placeholder' => 'Titre de la section (*)' ,
                        'data-label'=>'Titre de la section (*)'
                    ]
                ],
                'description'=>[
                    'label' => 'Description',
                    'attr'=>[
                        "class" =>'form_ctrl textarea_ctrl tinymce',
                        'data-theme' => 'bbcode'
                    ]
                ],
            ]
        ])
        ->add('position',null,array(
            'label'=>' ',
            'attr'=>array(
                'class'=>'blocPosition',
                'data-role' =>'parent'
            )
        ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContentElementsManagementSystemBundle\Entity\BlocSection'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'contentelementsmanagementsystembundle_blocsection';
    }


}
