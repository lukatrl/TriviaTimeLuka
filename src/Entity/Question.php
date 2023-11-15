<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\MetaData\ApiResource;


#[ApiResource(
    operations: [
        new Get(normalizationContext: ["groups" => "question:item"]),
        new GetCollection(normalizationContext: ["groups" => "question:list"])
    ]
)]

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[groups(['question:list', 'question:item', 'reponse:list', 'reponse:item', 'quiz:item', 'quiz:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[groups(['question:list', 'question:item', 'reponse:list', 'reponse:item', 'quiz:item', 'quiz:list'])]
    
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Reponse::class)]
    #[groups(['question:list', 'question:item', 'reponse:list', 'reponse:item', 'quiz:list', 'quiz:item'])]
    private Collection $reponses;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    #[groups(['question:list', 'question:item','quiz:list', 'quiz:item'])]
    private ?Quiz $quiz = null;

    #[ORM\Column(length: 255)]
    #[groups(['question:list', 'question:item', 'reponse:list', 'reponse:item', 'quiz:item', 'quiz:list'])]
    private ?string $contenu = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fileName = null;

    public function __construct()
    {
        $this->reponses = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Reponse>
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(Reponse $reponse): static
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses->add($reponse);
            $reponse->setQuestion($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): static
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getQuestion() === $this) {
                $reponse->setQuestion(null);
            }
        }

        return $this;
    }

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): static
    {
        $this->quiz = $quiz;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): static
    {
        $this->fileName = $fileName;

        return $this;
    }
}
