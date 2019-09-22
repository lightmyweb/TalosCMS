<?php

namespace ContentElementsManagementSystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
class BlocQuoteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('translations', TranslationsType::class,[
            'label'=>' ',
            'fields' =>[
                'content'=>[
                    'label' => 'Contenu',
                    'attr'=>[
                        "class" =>'form_ctrl textarea_ctrl tinymce',
                        'data-theme' => 'bbcode'
                    ]
                ],
                'author'=>[
                    'label' => 'Auteur',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class',
                        'data-label'=>'Auteur'
                    ]
                ]
            ]

        ])
        ->add('position',null,array(
            'label'=>' ',
            'attr'=>array(
                'class'=>'blocPosition',
                'data-role' =>'parent'
            )
        ));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContentElementsManagementSystemBundle\Entity\BlocQuote'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'contentelementsmanagementsystembundle_blocquote';
    }
}