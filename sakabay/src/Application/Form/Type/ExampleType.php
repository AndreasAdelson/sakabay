<?php

namespace App\Application\Form\Type;

use App\Domain\Model\Example;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

final class ExampleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $translator = $options['translator'];

        $builder
            ->add('nom', TextType::class, [
                'constraints' => [
                    new Assert\Assert\Length(['max' => 100, 'message' => 'Max 100 caractères']),
                ]
            ])
            ->add('consigne', TextType::class, [
                'constraints' => [
                    new Assert\Assert\Length(['max' => 300, 'message' => 'Max 300 caractères']),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Example::class,
            'csrf_protection' => false,
        ]);
        // $resolver->setRequired('translator');
    }
}
