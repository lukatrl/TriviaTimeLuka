<?php

namespace App\Form;

use App\Entity\Quiz;
use App\Entity\Question;
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


class AddQuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        //->add('image', FileType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=> 'fw-bold']])
        ->add('quiz', EntityType::class, [
            'class' => Quiz::class,
            'choice_label' => 'titre', 
            'placeholder' => 'Sélectionnez le quizz associé',
            'attr' => ['class' => 'form-control'], 
            'label_attr' => ['class' => 'fw-bold'], 
        ])
        ->add('image', FileType::class, array('label' => "Image de la question",
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
        ->add('contenu', TextType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=> 'fw-bold']])
        ->add('envoyer', SubmitType::class, ['attr' => ['class'=> 'btn bg-primary text-white m-4' ], 'row_attr' => ['class' => 'text-center'],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
