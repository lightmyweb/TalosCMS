<?php

namespace CoreSystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use A2lix\TranslationFormBundle\Form\Type\TranslationsType;

use Symfony\Component\Form\Extension\Core\Type\FileType;


class HelpType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder = $this->extraBuilderFields($builder);
        
    }
    private function extraBuilderFields( $builder ){
        $builder
        ->add('blocSections', CollectionType::class, array(
            'entry_type' => \ContentElementsManagementSystemBundle\Form\BlocSectionType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'delete_empty'=>true,
            'by_reference' => false,
            'prototype' => true,
            'entry_options'  => array(
                'attr'      => array('class' => 'sections-box')
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
            'data_class' => 'CoreSystemBundle\Entity\Help'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'CoreSystemBundle_help';
    }


}
