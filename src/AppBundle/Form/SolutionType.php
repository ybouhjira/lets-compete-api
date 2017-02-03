<?php

namespace AppBundle\Form;

use AppBundle\Entity\Langage;
use AppBundle\Entity\Participant;
use AppBundle\Entity\Solution;
use AppBundle\Entity\Probleme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class SolutionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('participant', EntityType::class, [
                'class' => Participant::class
            ])
            ->add('langage', EntityType::class, [
                'class' => Langage::class
            ])
            ->add('probleme', EntityType::class, [
                'class' => Probleme::class
            ])
            ->add('fichierZip', FileType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => Solution::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_solution';
    }


}
