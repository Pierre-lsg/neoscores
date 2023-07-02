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

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $competitionAt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $publishingScoresAt = null;

    #[ORM\ManyToOne(inversedBy: 'competitions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Championship $championship = null;

    #[ORM\ManyToOne(inversedBy: 'competitions')]
    private ?GolfCourse $golfcourse = null;

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

    public function getCompetitionAt(): ?\DateTimeInterface
    {
        return $this->competitionAt;
    }

    public function setCompetitionAt(\DateTimeInterface $competitionAt): static
    {
        $this->competitionAt = $competitionAt;

        return $this;
    }

    public function getPublishingScoresAt(): ?\DateTimeInterface
    {
        return $this->publishingScoresAt;
    }

    public function setPublishingScoresAt(\DateTimeInterface $publishingScoresAt): static
    {
        $this->publishingScoresAt = $publishingScoresAt;

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

    public function getGolfcourse(): ?GolfCourse
    {
        return $this->golfcourse;
    }

    public function setGolfcourse(?GolfCourse $golfcourse): static
    {
        $this->golfcourse = $golfcourse;

        return $this;
    }
}
