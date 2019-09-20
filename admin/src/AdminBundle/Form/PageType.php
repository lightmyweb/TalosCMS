<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use A2lix\TranslationFormBundle\Form\Type\TranslationsType;

class PageType extends AbstractType
{   

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options = $builder->getOptions();
        $page_id = $options['data']->getId();

        $builder
        ->add('translations', TranslationsType::class,[
            'label'=>' ',
            'fields' =>[
                'title'=>[
                    'label' => 'Nom (*)',
                    'attr'=>[
                        "class" =>'form_ctrl required_class theSlugInutWilTakeThisInputValue title_page',
                        'data-label'=>'Nom (*)'
                    ]
                ],
                'slug'=>[
                    'label' => 'Permalien (*)',
                    'attr'=>[
                        "class" =>'form_ctrl required_class slugInputFromOriginalTextInput slugTestIfExistInDatabase',
                        'data-entity'=>'Page',
                        'data-label'=>'Permalien (*)'
                    ]
                ],
                'title1'=>[
                    'label' => 'Titre',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'data-label'=>'Titre',
                        'required' => false
                    ]
                ],
                'title2'=>[
                    'label' => 'Sous titre',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'data-label'=>'Sous titre',
                        'required' => false
                    ]
                ],
                'email1'=>[
                    'label' => 'Email 1',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'data-label'=>'Email 1',
                        'required' => false
                    ]
                ],
                'email2'=>[
                    'label' => 'Email 2',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'data-label'=>'Email 2',
                        'required' => false
                    ]
                ],
                'classiceditor'=>[
                    'label' => 'Contenu',
                    'attr'=>[
                        "class" =>'form_ctrl textarea_ctrl tinymce',
                        'data-theme' => 'bbcode',
                        'data-label'=>'Contenu'
                    ]
                ]
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

        if( $page_id == 76 ){
            $builder = $this->extraBuilderFields( $builder );
        }
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
        ->add('blocGalleries', CollectionType::class, array(
            'entry_type' => \ContentElementsManagementSystemBundle\Form\BlocGalleryType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'delete_empty'=>true,
            'by_reference' => false,
            'prototype' => true,
            'entry_options'  => array(
                'attr'      => array('class' => 'textes-box')
            ),
        ))
        ->add('blocQuotes', CollectionType::class, array(
            'entry_type' => \ContentElementsManagementSystemBundle\Form\BlocQuoteType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'delete_empty'=>true,
            'by_reference' => false,
            'prototype' => true,
            'entry_options'  => array(
                'attr'      => array('class' => 'secions-box')
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