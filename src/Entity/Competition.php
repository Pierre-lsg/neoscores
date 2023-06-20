<?php

namespace App\Entity;

use App\Repository\CompetitionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetitionRepository::class)]
class Competition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $orderC = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateStartCompetition = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateScoresPublishing = null;

    #[ORM\ManyToOne(inversedBy: 'competitions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Championship $championship = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getOrderC(): ?int
    {
        return $this->orderC;
    }

    public function setOrderC(int $orderC): static
    {
        $this->orderC = $orderC;

        return $this;
    }

    public function getDateStartCompetition(): ?\DateTimeInterface
    {
        return $this->dateStartCompetition;
    }

    public function setDateStartCompetition(\DateTimeInterface $dateStartCompetition): static
    {
        $this->dateStartCompetition = $dateStartCompetition;

        return $this;
    }

    public function getDateScoresPublishing(): ?\DateTimeInterface
    {
        return $this->dateScoresPublishing;
    }

    public function setDateScoresPublishing(\DateTimeInterface $dateScoresPublishing): static
    {
        $this->dateScoresPublishing = $dateScoresPublishing;

        return $this;
    }

    public function getChampionship(): ?Championship
    {
        return $this->championship;
    }

    public function setChampionship(?Championship $championship): static
    {
        $this->championship = $championship;

        return $this;
    }
}
