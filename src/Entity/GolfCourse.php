<?php

namespace App\Entity;

use App\Repository\GolfCourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Spot;

#[ORM\Entity(repositoryClass: GolfCourseRepository::class)]
class GolfCourse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Target::class, inversedBy: 'golfCourses')]
    private Collection $targets;

    #[ORM\Column]
    #[Assert\GreaterThan(0)]
    private ?int $numberOfTargets = null;

    #[ORM\Column]
    private ?bool $isCompleted = null;

    #[ORM\ManyToOne(inversedBy: 'golfCourses')]
    private ?Spot $spot = null;

    #[ORM\OneToMany(mappedBy: 'golfcourse', targetEntity: Competition::class)]
    private Collection $competitions;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function __construct()
    {
        $this->targets = new ArrayCollection();
        $this->competitions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Target>
     */
    public function getTargets(): Collection
    {
        return $this->targets;
    }

    public function addTarget(Target $target): static
    {
        if (!$this->targets->contains($target)) {
            $this->targets->add($target);
        }

        return $this;
    }

    public function removeTarget(Target $target): static
    {
        $this->targets->removeElement($target);

        return $this;
    }

    public function getNumberOfTargets(): ?int
    {
        return $this->numberOfTargets;
    }

    public function setNumberOfTargets(int $numberOfTargets): static
    {
        $this->numberOfTargets = $numberOfTargets;

        return $this;
    }

    public function isIsCompleted(): ?bool
    {
        return $this->isCompleted;
    }

    public function setIsCompleted(bool $isCompleted): static
    {
        $this->isCompleted = $isCompleted;

        return $this;
    }

    public function evalGolfCourse()
    {
        if (count($this->getTargets()) == $this->getNumberOfTargets()) {
            $this->setIsCompleted(true);
        } else {
            $this->setIsCompleted(false);
        }

    }

    public function getSpot(): ?Spot
    {
        return $this->spot;
    }

    public function setSpot(?Spot $spot): static
    {
        $this->spot = $spot;

        return $this;
    }

    /**
     * @return Collection<int, Competition>
     */
    public function getCompetitions(): Collection
    {
        return $this->competitions;
    }

    public function addCompetition(Competition $competition): static
    {
        if (!$this->competitions->contains($competition)) {
            $this->competitions->add($competition);
            $competition->setGolfcourse($this);
        }

        return $this;
    }

    public function removeCompetition(Competition $competition): static
    {
        if ($this->competitions->removeElement($competition)) {
            // set the owning side to null (unless already changed)
            if ($competition->getGolfcourse() === $this) {
                $competition->setGolfcourse(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name . ' - ' . $this->spot;
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
}
