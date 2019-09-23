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
        $builder = $this->extraBuilderFields( $builder );
        /**
         * to test on page id 
         * if( $page_id == 1 ){ your code  }
        **/ 
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