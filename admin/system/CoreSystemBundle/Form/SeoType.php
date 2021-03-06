<?php

namespace CoreSystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use A2lix\TranslationFormBundle\Form\Type\TranslationsType;

class SeoType extends AbstractType
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
                    'label' => 'Title (*)',
                    'attr'=>[
                        "class" =>'form_ctrl  not_required_class forSlugyInput seo_title',
                        'data-label'=>'Title (*)',
                        'maxlength'=>70
                    ]
                ],
                'description'=>[
                    'label' => 'Meta description',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class textarea_ctrl seo_description',
                        'data-label'=>'Meta description (*)',
                        'maxlength'=>160
                    ]
                ],
            ]

        ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CoreSystemBundle\Entity\Seo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'CoreSystemBundle_seo';
    }


}
