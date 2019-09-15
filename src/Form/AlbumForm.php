<?php

namespace App\Form;

use App\Entity\Album;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'attr' => [
                    'class' => 'input100',
                    'required' => true,
                    'autofocus' => true,
                ],
                'label_attr' => [
                    'class' => 'label-input100',
                ],
            ])
        ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
