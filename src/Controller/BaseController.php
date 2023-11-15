<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use App\Entity\Quiz;
use App\Entity\Question;
use App\Entity\Reponse;



class BaseController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $emi): Response
    {
        $repoQuiz =  $emi->getRepository(Quiz::class);
        $quiz = $repoQuiz->findAll();
        return $this->render('base/index.html.twig', [
            'quizzList' => $quiz
        ]);
    }


    #[Route('/quizz-id/{id}', name: 'quizz-id')]  // /base est l’URL de la page, name est le nom de la route
    public function ReponseContact(Request $request, EntityManagerInterface $emi): Response
    {
        $id = $request->get('id');
        $repoQuiz = $emi->getRepository(Quiz::class);
        $quiz = $repoQuiz->find($id);
        $repoQuestion = $emi->getRepository(Question::class);
        $question = $repoQuestion->find($id);
        
        return $this->render('base/pageQuizz.html.twig', [ // render est la fonction qui va chercher le fichier TWIG pour l’afficher
            'quiz' => $quiz,
            'questions' => $question

        ]);
    }
}
