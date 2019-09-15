<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Gif;
use App\Repository\AlbumRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class GifAddForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $user = $options['user'];

        $builder
            ->add('url', null, [
                'attr' => [
                    'class' => 'input100',
                    'required' => true,
                    'autofocus' => true,
                ],
                'label_attr' => [
                    'class' => 'label-input100',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please write the url with .gif ;',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your url should be at least {{ limit }} characters and end with .gif',
                        'max' => 100,
                    ]),
                ],
            ])
            ->add('album', EntityType::class, [
                'class' => Album::class,
//                'query_builder' => function (AlbumRepository $er) use ($user) {
//                    return $er->createQueryBuilder('u')
//                        ->where('author', $user);
//                },
                'choice_label' => 'title',
                'attr' => [
                    'class' => 'input100',
                    'required' => true,
                    'autofocus' => true,
                ],
                'label_attr' => [
                    'class' => 'label-input100',
                ]
            ])
            ->add('tags', null, [
                'attr' => [
                    'class' => 'input100',
                    'required' => true,
                    'autofocus' => true,
                ],
                'label_attr' => [
                    'class' => 'label-input100',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please write tags seperated with ;',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Your tag should be at least {{ limit }} characters',
                        'max' => 20,
                    ]),
                ],
            ])
        ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Gif::class,
            'user' => User::class,
        ]);
    }
}
