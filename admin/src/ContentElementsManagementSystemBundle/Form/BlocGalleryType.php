<?php

namespace ContentElementsManagementSystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class BlocGalleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
        ->add('thumbnail',null,array(
            'attr'=>array(
                'class'=>"fileUploadTrigger",
                'data-label'=>"importer une image"
            )
        ))
        ->add('galleryimages', CollectionType::class, array(
            'label' => ' ',
            'entry_type' => BlocGalleryimageType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'delete_empty'=>true,
            'by_reference' => false,
            'prototype' => true,
            'prototype_name' => '__child_prot__',
            'entry_options'  => array(
                'attr'      => array('class' => 'section-membergroup-groupMembers-box')
            ),
        ))
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
            'data_class' => 'ContentElementsManagementSystemBundle\Entity\BlocGallery'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'contentelementsmanagementsystembundle_blocgallery';
    }
}