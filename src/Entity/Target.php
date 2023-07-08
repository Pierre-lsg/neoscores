<?php

namespace App\Entity;

use App\Repository\TargetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TargetRepository::class)]
class Target
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $par = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rule $rule = null;

    #[ORM\ManyToMany(targetEntity: GolfCourse::class, mappedBy: 'targets')]
    private Collection $golfCourses;

    #[ORM\ManyToOne(inversedBy: 'targets')]
    private ?Spot $spot = null;

    public function __construct()
    {
        $this->golfCourses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPar(): ?int
    {
        return $this->par;
    }

    public function setPar(int $par): self
    {
        $this->par = $par;

        return $this;
    }

    public function getRule(): ?Rule
    {
        return $this->rule;
    }

    public function setRule(?Rule $rule): self
    {
        $this->rule = $rule;

        return $this;
    }

    /**
     * @return Collection<int, GolfCourse>
     */
    public function getGolfCourses(): Collection
    {
        return $this->golfCourses;
    }

    public function addGolfCourse(GolfCourse $golfCourse): static
    {
        if (!$this->golfCourses->contains($golfCourse)) {
            $this->golfCourses->add($golfCourse);
            $golfCourse->addTarget($this);
        }

        return $this;
    }

    public function removeGolfCourse(GolfCourse $golfCourse): static
    {
        if ($this->golfCourses->removeElement($golfCourse)) {
            $golfCourse->removeTarget($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name . ' - ' . $this->spot;
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
