<?php

namespace CoreSystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use CoreSystemBundle\Entity\User;
class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $data = $options['data'];
 
        
        $builder
            ->add('first_name', null, array(
                'label' => 'Prénom (*)',
                'attr'=>array(
                    'class'=>'form_ctrl required_class',
                    'required' => true,
               ))
            )
            ->add('last_name', null, array(
                'label' => 'Nom *',
                'attr'=>array(
                    'class'=>'form_ctrl required_class',
                    'required' => true,
                )
            ))
            ->add('username', null, array(
                'label' => 'Login (Nom d\'utilisateur) *',
                'attr'=>array(
                    'class'=>'form_ctrl required_class',
                )
            ))
            ->add('email', null, array(
                'label' => "Email *" ,
                'attr'=>array(
                    'class'=>'form_ctrl required_class',
                )
            ))
            ->add('password', PasswordType::class, array(
                'label' => 'Mot de passe *',
                'attr'=>array(
                    'class'=>'form_ctrl ',
                    'required' => true,
                    'data-validate-length-range' => '6,255'
                )
            ));
            if( $data->getRole() == 'ROLE_SUPER_ADMIN' )
                $builder->add('role', null, array(
                    'disabled' => "disabled",
                    'attr'=>array(
                        'class'=>'form_ctrl required_class',
                    )
                ));
            else
            $builder->add('role', ChoiceType::class, array(
                'label' => 'Role *', 
                'choices' => array( 
                    'Editeur' => 'ROLE_EDITOR', 
                    'Administrateur' => 'ROLE_ADMIN',
                    'Developpeur' => 'ROLE_DEV' ,
                    'Super Administrateur' => 'ROLE_SUPER_ADMIN' 
                ),
                'attr'=>array(
                'class'=>'form_ctrl required_class',
               
            )));
            $builder->add('is_active', CheckboxType::class, array(
                    'label'    => 'Active',
                    'required' => false,
                    'attr'=>array(
                        'class'=>'onoffswitch-checkbox'
                    )
                )
            );
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CoreSystemBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'user';
    }
}