<?php

namespace ContentElementsManagementSystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class BlocImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
        ->add('thumbnail',null,array(
            'attr'=>array(
                'class'=>"fileUploadTrigger",
                'data-label'=>"importer une image",
                'required'=>'true'
            )
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
            'data_class' => 'ContentElementsManagementSystemBundle\Entity\BlocImage'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'contentelementsmanagementsystembundle_blocimage';
    }
}