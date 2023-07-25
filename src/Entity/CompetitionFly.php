<?php

namespace App\Entity;

use App\Repository\CompetitionFlyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetitionFlyRepository::class)]
class CompetitionFly
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'competitionFlies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Competition $competition = null;

    #[ORM\OneToMany(mappedBy: 'competitionFly', targetEntity: Team::class)]
    private Collection $teams;

    #[ORM\OneToMany(mappedBy: 'competitionFly', targetEntity: Member::class)]
    private Collection $Players;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->Players = new ArrayCollection();
    }

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

    public function getCompetition(): ?Competition
    {
        return $this->competition;
    }

    public function setCompetition(?Competition $competition): static
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * @return Collection<int, Teams>
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): static
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
            $team->setCompetitionFly($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): static
    {
        if ($this->teams->removeElement($team)) {
            // set the owning side to null (unless already changed)
            if ($team->getCompetitionFly() === $this) {
                $team->setCompetitionFly(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Member>
     */
    public function getPlayers(): Collection
    {
        return $this->Players;
    }

    public function addPlayer(Member $player): static
    {
        if (!$this->Players->contains($player)) {
            $this->Players->add($player);
            $player->setCompetitionFly($this);
        }

        return $this;
    }

    public function removePlayer(Member $player): static
    {
        if ($this->Players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getCompetitionFly() === $this) {
                $player->setCompetitionFly(null);
            }
        }

        return $this;
    }
}
