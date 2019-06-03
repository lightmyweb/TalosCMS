<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class LocaleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,array(
                'label'=> ' ',
                'attr'=> array(
                    'class'=> 'form_ctrl required_class',
                    'placeholder'=>'Nom (*)',
                    'required'=>'required',
                    'data-label'=>'Nom (*)'
                )
            ))
            ->add('slug',null,array(
                'label'=> ' ',
                'attr'=> array(
                    'class'=> ' form_ctrl required_class slugTestIfExistInDatabase',
                    'placeholder'=>'Permalien (*)',
                    'required'=>'required',
                    'data-entity'=>'Locale',
                    'data-label'=>'Permalien (*)'
                )
            ))
             ->add('state',ChoiceType::class,array(
                'choices' => array(                  
                    'Brouillon' => -1, 
                    'Off-Line ' => 0,
                    'On-Line' => 1 
                ),
                'attr'=>array(
                    'class'=>'select_ctrl_state'
                )
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Locale'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_locale';
    }


}
