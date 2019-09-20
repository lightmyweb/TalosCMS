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

class LocationType extends AbstractType
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
                'city'=>[
                    'label' => 'Ville (*)',
                    'attr'=>[
                        "class" =>'form_ctrl required_class title_page',
                        'data-label'=>'Ville (*)'
                    ]
                ],
                'country'=>[
                    'label' => 'Pays',
                    'attr'=>[
                        "class" =>'form_ctrl not_required_class title_page',
                        'data-label'=>'Pays'
                    ]
                ]
            ]

        ])
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
            'data_class' => 'AdminBundle\Entity\Location'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_location';
    }


}
