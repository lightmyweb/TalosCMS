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

class ProjectType extends AbstractType
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
                'title'=>[
                    'label' => 'Titre (*)',
                    'attr'=>[
                        "class" =>'form_ctrl required_class theSlugInutWilTakeThisInputValue title_project',
                        'data-label'=>'Titre (*)'
                    ]
                ],
                'slug'=>[
                    'label' => 'Permalien (*)',
                    'attr'=>[
                        "class" =>'form_ctrl required_class slugInputFromOriginalTextInput slugTestIfExistInDatabase',
                        'data-entity'=>'Project',
                        'data-label'=>'Permalien (*)'
                    ]
                ],
                'program'=>[
                    'label' => 'Programme',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'data-entity'=>'Project',
                        'data-label'=>'Programme'
                    ]
                ],
                'area'=>[
                    'label' => 'Surface',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'data-entity'=>'Project',
                        'data-label'=>'Surface'
                    ]
                ],
                'date'=>[
                    'label' => 'Date',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'data-entity'=>'Project',
                        'data-label'=>'Date'
                    ]
                ],
                'photographer'=>[
                    'label' => 'Photographe',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'data-entity'=>'Project',
                        'data-label'=>'Photographe'
                    ]
                ],
                'descriptiontitle'=>[
                    'label' => 'Description - Titre',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'data-entity'=>'Project',
                        'data-label'=>'Description - Titre'
                    ]
                ],
                'descriptionintro'=>[
                    'label' => 'Description - Intro',
                    'attr'=>[
                        "class" =>'form_ctrl textarea_ctrl tinymce',
                        'data-theme' => 'bbcode',
                    ]
                ],
                'descriptioncontent'=>[
                    'label' => 'Description - Contenu',
                    'attr'=>[
                        "class" =>'form_ctrl textarea_ctrl tinymce',
                        'data-theme' => 'bbcode',
                    ]
                ],
            ]
        ])
        
        ->add('seo', SeoType::class,array(
            'label'=>' '
        ))

        ->add('image',null,array(
            'attr'=>array(
                'class'=>"fileUploadTrigger",
                'data-label'=>"importer une image"
            )
        ))

        ->add('category',null,array(
            'label'=> 'Catégorie',
            'placeholder' =>'Selectionner une ou plusieurs catégories'
        ))

        ->add('client',null,array(
            'label'=> 'Client',
            'placeholder' =>'Selectionner un ou plusieurs clients'
        ))

        ->add('location',null,array(
            'label'=> 'Location',
            'placeholder' =>'Selectionner une ou plusieurs locations'
        ))
        
        ->add('state',ChoiceType::class,array(
            'choices' => array(
                'On-Line' => 1,
                'Off-Line ' => 0
            ),
            'attr'=>array(
                'class'=>'select_ctrl_state'
            )
        ));

        $builder = $this->extraBuilderFields( $builder );
    }

    private function extraBuilderFields( $builder ){
        $builder
        ->add('blocImages', CollectionType::class, array(
            'entry_type' => \ContentElementsManagementSystemBundle\Form\BlocImageType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'delete_empty'=>true,
            'by_reference' => false,
            'prototype' => true,
            'entry_options'  => array(
                'attr'      => array('class' => 'textes-box')
            ),
        ));

        return $builder;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Project'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_project';
    }


}
