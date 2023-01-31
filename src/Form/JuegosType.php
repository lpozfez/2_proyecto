<?php

namespace App\Form;

use App\Entity\Juego;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class JuegosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre',TextType::class)
            ->add('editorial',TextType::class)
            ->add('minJugadores',IntegerType::class)
            ->add('maxJugadores',IntegerType::class)
            ->add('anchoTablero',NumberType::class)
            ->add('altoTablero',NumberType::class)
            ->add('imagen',FileType::class)
            ->add('guardar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Juego::class,
        ]);
    }
}
