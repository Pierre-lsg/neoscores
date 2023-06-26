<?php

namespace App\Entity;

use App\Repository\SpotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpotRepository::class)]
class Spot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $place = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\OneToMany(mappedBy: 'spot', targetEntity: Target::class)]
    private Collection $targets;

    #[ORM\OneToMany(mappedBy: 'spot', targetEntity: GolfCourse::class)]
    private Collection $golfCourses;

    public function __construct()
    {
        $this->targets = new ArrayCollection();
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): static
    {
        $this->place = $place;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
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
            $target->setSpot($this);
        }

        return $this;
    }

    public function removeTarget(Target $target): static
    {
        if ($this->targets->removeElement($target)) {
            // set the owning side to null (unless already changed)
            if ($target->getSpot() === $this) {
                $target->setSpot(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
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
            $golfCourse->setSpot($this);
        }

        return $this;
    }

    public function removeGolfCourse(GolfCourse $golfCourse): static
    {
        if ($this->golfCourses->removeElement($golfCourse)) {
            // set the owning side to null (unless already changed)
            if ($golfCourse->getSpot() === $this) {
                $golfCourse->setSpot(null);
            }
        }

        return $this;
    }
}
