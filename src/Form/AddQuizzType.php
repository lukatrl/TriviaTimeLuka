<?php

namespace App\Form;

use App\Entity\Quiz;
use App\Entity\Categorie;
use App\Entity\Difficulte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;


class AddQuizzType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        //->add('image', FileType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=> 'fw-bold']])
        ->add('image', FileType::class, array('label' => "Image du quizz",
            'constraints' => [
                new File([
                    'maxSize' => '5000000k',
                    'mimeTypes' => [
                        'image/jpg',
                        'image/webp',
                        'image/png',
                        'image/gif',
                    ],
                    'mimeTypesMessage' => 'Le site accepte uniquement les fichiers PNG, JPG, webp et gif',
                ])
            ],))
        ->add('titre', TextType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=> 'fw-bold']])
        ->add('nbQuestion', TextType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=> 'fw-bold']])
        ->add('difficulty', EntityType::class, [
            'class' => Difficulte::class,
            'choice_label' => 'name',
            'placeholder' => 'Sélectionnez la difficulté',
            'attr' => ['class' => 'form-control'],
            'label_attr' => ['class' => 'fw-bold'],
            'required' => true, // Assurez-vous que le champ est requis
        ])
        
        ->add('categorie', EntityType::class, [
            'class' => Categorie::class,
            'choice_label' => 'nom', 
            'placeholder' => 'Sélectionnez une catégorie',
            'attr' => ['class' => 'form-control'], 
            'label_attr' => ['class' => 'fw-bold'], 
        ])
        ->add('envoyer', SubmitType::class, ['attr' => ['class'=> 'btn bg-primary text-white m-4' ], 'row_attr' => ['class' => 'text-center'],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quiz::class,
        ]);
    }
}
