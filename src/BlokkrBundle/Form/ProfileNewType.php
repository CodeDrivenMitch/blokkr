<?php

namespace BlokkrBundle\Form;

use BlokkrBundle\Entity\Profile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileNewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('shortcut', TextType::class, array(
                'label' => "Shortcut",
                'help_label' => 'This will be the link to your profile, e.g. blokkr.com/profile/<your_shortcut>',
                'attr' => array(
                    'placeholder' => "blokkr_is_awesome_7645",
                )
            ))
            ->add('bio')
        ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Profile::class,
        ));
    }

    public function getName()
    {
        return 'blokkr_bundle_profile_type';
    }
}
