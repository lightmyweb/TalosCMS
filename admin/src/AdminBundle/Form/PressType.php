<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PressType extends AbstractType
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
                'name'=>[
                    'label' => 'Nom (*)',
                    'attr'=>[
                        "class" =>'form_ctrl required_class title_page',
                        'data-label'=>'Nom (*)'
                    ]
                ],
                'country'=>[
                    'label' => 'Pays',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'data-label'=>'Pays',
                        'required' => false
                    ]
                ],
                'abstract'=>[
                    'label' => 'Résumé',
                    'attr'=>[
                        "class" =>'form_ctrl textarea_ctrl tinymce',
                        'data-theme' => 'bbcode',
                    ]
                ],
                'date'=>[
                    'label' => 'Date',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'data-label'=>'Date',
                        'required' => false
                    ]
                ],
                'linkText'=>[
                    'label' => 'Lien (texte)',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'data-label'=>'Lien (texte)',
                        'required' => false
                    ]
                ],
                'linkUrl'=>[
                    'label' => 'Lien (url)',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'required' => false
                    ]
                ],
                'pdf'=>[
                    'label' => '',
                    'field_type' => FileType::class, 
                    'required'=> false,
                    'data_class' => null,
                    'attr'=>[
                        "class" =>'fileinput',
                        'placeholder' =>''
                    ]
                ]
            ]
        ])
        ->add('thumbnail',null,array(
            'attr'=>array(
                'class'=>"fileUploadTrigger",
                'data-label'=>"importer une image"
            )
        ))
        ->add('state',ChoiceType::class,array(
            'choices' => array(
                'On-Line' => 1,
                'Off-Line ' => 0
            ),
            'attr'=>array(
                'class'=>'select_ctrl_state'
            )
        ))
        ->add('user')
        ->add('updateuser');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Press'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_press';
    }
}