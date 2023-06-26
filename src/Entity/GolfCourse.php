<?php

namespace App\Entity;

use App\Repository\GolfCourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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

    public function __construct()
    {
        $this->targets = new ArrayCollection();
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
}
