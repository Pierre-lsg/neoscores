<?php

namespace App\Entity;

use App\Repository\GolfCourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
    private ?int $numberOfTargets = null;

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
}
