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

class HomeType extends AbstractType
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
                    'label' => 'Bloc top : Titre',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'data-label'=>'Titre'
                    ]
                ],
                'description'=>[
                    'label' => 'Bloc top : Description',
                    'attr'=>[
                        "class" =>'form_ctrl textarea_ctrl tinymce',
                        'data-theme' => 'bbcode',
                        'data-label'=>'Description'
                    ]
                ],
                'aboutTitle'=>[
                    'label' => 'Bloc à propos - Titre',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'data-entity'=>'Home',
                        'data-label'=>'Bloc à propos - Titre'
                    ]
                ],
                'aboutSubtitle'=>[
                    'label' => 'Bloc à propos - Sous titre',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'data-entity'=>'Home',
                        'data-label'=>'Bloc à propos - Sous titre'
                    ]
                ],
                'aboutIntro'=>[
                    'label' => 'Bloc à propos - Intro',
                    'attr'=>[
                        "class" =>'form_ctrl textarea_ctrl tinymce',
                        'data-theme' => 'bbcode',
                        'data-label'=>'Bloc à propos - Intro'
                    ]
                ],
                'aboutText'=>[
                    'label' => 'Bloc à propos - Texte',
                    'attr'=>[
                        "class" =>'form_ctrl textarea_ctrl tinymce',
                        'data-theme' => 'bbcode',
                        'data-label'=>'Bloc à propos - Texte'
                    ]
                ],
                'aboutCaption'=>[
                    'label' => 'Bloc à propos - Caption',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'data-entity'=>'Home',
                        'data-label'=>'Bloc à propos - Caption'
                    ]
                ],
                'aboutQuote'=>[
                    'label' => 'Bloc à propos - Citation',
                    'attr'=>[
                        "class" =>'form_ctrl textarea_ctrl tinymce',
                        'data-theme' => 'bbcode',
                        'data-label'=>'Bloc à propos - Citation'
                    ]
                ]
            ]
        ])

        ->add('projects')

        ->add('aboutImage',null,array(
            'attr'=>array(
                'class'=>"fileUploadTrigger",
                'data-label'=>"importer une image"
            )
        ))

        ->add('seo', SeoType::class,array(
            'label'=>' '
        ))
        ->add('user')
        ->add('updateuser');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Home'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_home';
    }


}
