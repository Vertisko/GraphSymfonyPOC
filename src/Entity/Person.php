<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonRepository::class)
 */
class Person
{
    const TITLE_UNKNOWN = 0;
    const TITLE_MISS = 1;
    const TITLE_MRS = 2;
    const TITLE_MS = 3;
    const TITLE_MR = 4;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToOne(targetEntity=Animal::class, cascade={"persist", "remove"})
     */
    private $pet;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity=Vehicle::class, mappedBy="person")
     */
    private $vehicles;

    public function __construct(
        string $id,
        string $name,
        int $title = self::TITLE_UNKNOWN,
        \DateTime $birthDate = null,
        ?Animal $pet = null,
        array $vehicles = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
        $this->birthDate = $birthDate;
        $this->createdAt = new \Datetime();
        $this->pet = $pet;
        $this->vehicles = $vehicles;
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPet(): ?Animal
    {
        return $this->pet;
    }

    public function setPet(?Animal $pet): self
    {
        $this->pet = $pet;

        return $this;
    }

    /**
     * @return Collection|Vehicle[]
     */
    public function getVehicles(): Collection
    {
        return $this->vehicles;
    }

    public function addVehicle(Vehicle $vehicle): self
    {
        if (!$this->vehicles->contains($vehicle)) {
            $this->vehicles[] = $vehicle;
            $vehicle->setPerson($this);
        }

        return $this;
    }

    public function removeVehicle(Vehicle $vehicle): self
    {
        if ($this->vehicles->contains($vehicle)) {
            $this->vehicles->removeElement($vehicle);
            // set the owning side to null (unless already changed)
            if ($vehicle->getPerson() === $this) {
                $vehicle->setPerson(null);
            }
        }

        return $this;
    }
}
