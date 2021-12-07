<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class,[
                'disabled'=>true,// desactivena satria ts mila modifiena
                'label'=>'Mon adresse Email'
            ])
            ->add('roles')
          
            ->add('firstName',TextType::class,[
                'disabled'=>true,// desactivena satria ts mila modifiena
                'label'=>'Mon prénom'
            ])
            ->add('lastName',TextType::class,[
                'disabled'=>true,// desactivena satria ts mila modifiena
                'label'=>'Mon nom'
            ])
            ->add('old_password',PasswordType::class,[
                'mapped'=>false,//atao tsisy ifandraisany @ entité User satria ny old_password tsisy ao @ entite User
                'label'=>'Mon mot de passe actuel',
                'attr'=>[
                    'placeholder'=>'Veuillez saisir votre mot de passe actuel'
                ]
            ])
             // fitambarany,anakiroa fa mitovy ihany,misy validation ts maints mitovy automatik a 
            ->add('new_password',RepeatedType::class,[ 
                'type'=>PasswordType::class,
                'invalid_message'=>'Le mot de passe et la confirmation doivent être identique',
                //'label'=>'Mot de passe:',
                'mapped'=>false,//atao tsisy ifandraisany @ entité User fa ho alaina direct
                'required'=>true,// ts maintsy fenoina
                'first_options'=>[// mdp vao2
                   'label'=>'Nouveau mot de passe',
                    'attr'=>[
                        'placeholder'=>'Ici, votre nouveau mdp ...'
                    ]
                ],
                'second_options'=>[//confirmation ilay mdp vao2
                    'label'=>'Confirmez votre nouveau mot de passe',
                    'attr'=>[
                        'placeholder'=>'Ici, confirmation de nouveau mdp ...'
                    ]
                ],
               
            ])
            ->add('submit',SubmitType::class,[
                'label'=>'Modifier'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
