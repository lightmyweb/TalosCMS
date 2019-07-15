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
class PageType extends AbstractType
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
                        "class" =>'form_ctrl required_class theSlugInutWilTakeThisInputValue title_page',
                        'placeholder' =>'Titre (*)',
                        'data-label'=>'Titre (*)',
                        'required' => true
                    ]
                ],
                'suptitle'=>[
                    'label' => 'Sous titre',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'placeholder' =>'Sous titre ',
                        'data-label'=>'Sous titre',
                        'required' => true
                    ]
                ],
                'slug'=>[
                    'label' => 'Permalien (*)',
                    'attr'=>[
                        "class" =>'form_ctrl required_class slugInputFromOriginalTextInput slugTestIfExistInDatabase',
                        'placeholder' =>'Permalien (*)',
                        'data-entity'=>'Page',
                        'data-label'=>'Permalien (*)',
                        'required' => true
                    ]
                ],
                'description'=>[
                    'label' => 'Description',
                    'attr'=>[
                        "class" =>'form_ctrl textarea_ctrl tinymce',
                        'data-theme' => 'bbcode',
                        'placeholder' =>'Description',
                        'required' => true
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
        ->add('blocTexts', CollectionType::class, array(
            'entry_type' => \ContentElementsManagementSystemBundle\Form\BlocTextType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'delete_empty'=>true,
            'by_reference' => false,
            'prototype' => true,
            'entry_options'  => array(
                'attr'      => array('class' => 'textes-box')
            ),
        ))
        ->add('blocSections', CollectionType::class, array(
            'entry_type' => \ContentElementsManagementSystemBundle\Form\BlocSectionType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'delete_empty'=>true,
            'by_reference' => false,
            'prototype' => true,
            'entry_options'  => array(
                'attr'      => array('class' => 'secions-box')
            ),
        )) ;

        return $builder;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Page'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_page';
    }


}
