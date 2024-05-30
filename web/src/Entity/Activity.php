<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $day_1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $day_2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $day_3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $day_4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $day_5 = null;

    #[ORM\Column]
    private ?float $longitude = null;

    #[ORM\Column]
    private ?float $latitude = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay1(): ?string
    {
        return $this->day_1;
    }

    public function setDay1(?string $day_1): static
    {
        $this->day_1 = $day_1;

        return $this;
    }

    public function getDay2(): ?string
    {
        return $this->day_2;
    }

    public function setDay2(?string $day_2): static
    {
        $this->day_2 = $day_2;

        return $this;
    }

    public function getDay3(): ?string
    {
        return $this->day_3;
    }

    public function setDay3(?string $day_3): static
    {
        $this->day_3 = $day_3;

        return $this;
    }

    public function getDay4(): ?string
    {
        return $this->day_4;
    }

    public function setDay4(?string $day_4): static
    {
        $this->day_4 = $day_4;

        return $this;
    }

    public function getDay5(): ?string
    {
        return $this->day_5;
    }

    public function setDay5(?string $day_5): static
    {
        $this->day_5 = $day_5;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }
}
