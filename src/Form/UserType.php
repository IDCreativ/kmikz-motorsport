<?php

namespace App\Form;

use App\Entity\User;
use App\Form\JobType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur'       => 'ROLE_USER',
                    'Organisateur'      => 'ROLE_ORGA',
                    'Administrateur'    => 'ROLE_ADMIN'
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => 'Rôles' 
            ])
            ->add('job')
            ->add('isVerified')
            ->add('pseudo')
            ->add('firstname')
            ->add('lastname')
            ->add('address')
            ->add('city')
            ->add('postalCode')
            ->add('telephone')
            ->add('imageFile', VichImageType::class, [
                'label' => 'Photo',
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'delete',
                'download_uri' => '...',
                'download_label' => true,
                'asset_helper' => true,
                'imagine_pattern' => 'form_minia',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
