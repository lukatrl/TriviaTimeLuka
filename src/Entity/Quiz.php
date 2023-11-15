<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\MetaData\ApiResource;
use ApiPlatform\Doctrine\Orm\Filter\ExistsFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;

#[ApiResource(
    operations: [
        new Get(normalizationContext: ["groups" => "quiz:item"]),
        new GetCollection(normalizationContext: ["groups" => "quiz:list"])
    ]
)]
#[ORM\Entity(repositoryClass: QuizRepository::class)]

class Quiz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[groups(['quiz:list', 'quiz:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[groups(['quiz:list', 'quiz:item'])]
    private ?string $image = null;


    #[ORM\Column(length: 255)]
    #[groups(['quiz:list', 'quiz:item'])]
    private ?string $titre = null;

    #[ORM\Column]
    #[groups(['quiz:list', 'quiz:item'])]
    private ?int $nbQuestion = null;

    #[ORM\OneToMany(mappedBy: 'quiz', targetEntity: Question::class)]
    #[groups(['quiz:list', 'quiz:item'])]
    private Collection $questions;

    #[ORM\ManyToOne(inversedBy: 'quizzes')]
    #[ORM\JoinColumn(nullable: false)]
    #[groups(['quiz:list', 'quiz:item'])]
    private ?Categorie $categorie = null;



    #[ORM\ManyToOne(inversedBy: 'quizzes')]
    private ?Difficulte $difficulty = null;

    #[ORM\Column(length: 255)]
    private ?string $fileName = null;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNbQuestion(): ?int
    {
        return $this->nbQuestion;
    }

    public function setNbQuestion(int $nbQuestion): static
    {
        $this->nbQuestion = $nbQuestion;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setQuiz($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuiz() === $this) {
                $question->setQuiz(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }





    public function getDifficulty(): ?Difficulte
    {
        return $this->difficulty;
    }

    public function setDifficulty(?Difficulte $difficulty): static
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): static
    {
        $this->fileName = $fileName;

        return $this;
    }
}
