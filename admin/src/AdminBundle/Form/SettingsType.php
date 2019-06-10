<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use A2lix\TranslationFormBundle\Form\Type\TranslationsType;


class SettingsType extends AbstractType
{
    /**
     * {@inheritdoc} 
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('translations', TranslationsType::class,[
            'label'=>' ',
            'fields' =>[
                'description'=>[
                    'label' => 'Description bas de page ',
                    'attr'=>[
                        "class" =>'form_ctrl textarea_ctrl required_class',
                        'placeholder' =>'Description bas de page',
                        'data-label'=>'Description bas de page'
                    ]
                ],
            ]

        ])
        ->add('title',null,array(
            'attr'=>array(
                'class'=>'form_ctrl required_class ',
                'data-label'=>'Titre du site',
            )
        ))
        ->add('widthForCrop',null,array(
            'attr'=>array(
                'class'=>'form_ctrl  ',
                'placeholder' =>'Largeur',
                'data-label'=>'Largeur'
            )
        ))
        ->add('heigthForCrop',null,array(
            'attr'=>array(
                'class'=>'form_ctrl  ',
                'placeholder' =>'Hauteur',
                'data-label'=>'Hauteur'
            )
        ))
        ->add('email',null,array(
            'attr'=>array(
                'class'=>'form_ctrl required_class email_class ',
                'data-label'=>'Email de contact ',
            )
        ))
        ->add('favicon',  FileType::class,array(
            'required'=>false,
            'data_class' => null,
            'required'=>false,
            'label'=>"Favicon ",
            'attr'=>array(
                'class'=>'required_class fileinput inputimageUpload'
            )
        ))
        ->add('installed');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Settings'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_settings';
    }


}
