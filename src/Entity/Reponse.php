<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\MetaData\ApiResource;

#[ApiResource(
    operations: [
        new Get(normalizationContext: ["groups" => "reponse:item"]),
        new GetCollection(normalizationContext: ["groups" => "reponse:list"])
    ]
)]

#[ORM\Entity(repositoryClass: ReponseRepository::class)]
class Reponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[groups(['reponse:list', 'reponse:item', 'quiz:list', 'quiz:item'])]
    private ?bool $isTrue = null;

    #[ORM\Column(type: Types::TEXT)]
    #[groups(['reponse:list', 'reponse:item', 'quiz:list', 'quiz:item'])]
    private ?string $contenu = null;

    #[ORM\ManyToOne(inversedBy: 'reponses')]
    #[ORM\JoinColumn(nullable: false)]
    #[groups(['reponse:list', 'reponse:item', 'question:item', 'question:list', 'quiz:list', 'quiz:item'])]
    private ?Question $question = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsTrue(): ?bool
    {
        return $this->isTrue;
    }

    public function setIsTrue(bool $isTrue): static
    {
        $this->isTrue = $isTrue;

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

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): static
    {
        $this->question = $question;

        return $this;
    }
}
