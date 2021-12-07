<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',TextType::class,[
                'label'=>'Prénom:',
                'constraints'=>new Length([ // automatik ny soratra msg eto aloha a
                    'min'=>2,
                    'max'=>30
                    ]),
                'attr'=>[
                    'placeholder'=>'Ici, votre prénom ...'
                ]
            ])
            ->add('lastName',TextType::class,[
                'label'=>'Nom:',
                'constraints'=>new Length([
                    'min'=>2,
                    'max'=>30
                    ]),
                'attr'=>[
                    'placeholder'=>'Ici, votre nom ...'
                ]
            ])
                
            ->add('email',EmailType::class,[
                'label'=>'Email:',
                'constraints'=>new Length([
                    'min'=>2,
                    'max'=>60
                    ]),
                'attr'=>[
                    'placeholder'=>'Ici, votre email ...'
                ]
            ])
            //->add('roles')
           /* ->add('password',PasswordType::class,[
                'label'=>'Mot de passe:',
                'attr'=>[
                    'placeholder'=>'Ici, votre mot de passe...'
                ]
            ])

            ->add('password_confirm',PasswordType::class,[
                'label'=>'Confirmez votre mot de passe:',
                'mapped'=>false, // @zay tsy relié @ entité User
                'attr'=>[
                    'placeholder'=>'Ici, confirmation mot de passe ...'
                ]
            ])*/
            // fitambarany password sy password_confirm
            ->add('password',RepeatedType::class,[
                'type'=>PasswordType::class,
                'invalid_message'=>'Le mot de passe et la confirmation doivent être identique',
                //'label'=>'Mot de passe:',
                'required'=>true,// ts maintsy fenoina
                'first_options'=>[
                    'label'=>'Mot de passe',
                    'attr'=>[
                        'placeholder'=>'Ici, votre nom ...'
                    ]
                ],
                'second_options'=>[
                    'label'=>'Confirmez votre mot de passe',
                    'attr'=>[
                        'placeholder'=>'Ici, votre confirmation de mdp ...'
                    ]
                ],
               
            ])
            ->add('submit',SubmitType::class,[
                'label'=>'Inscription'
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
