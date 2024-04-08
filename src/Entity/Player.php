<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $nationality = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $course = null;

    #[ORM\Column]
    private ?int $goalsNumber = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthDate = null;

    #[ORM\ManyToOne(inversedBy: 'player')]
    private ?ClubTeam $clubTeam = null;

    #[ORM\ManyToOne(inversedBy: 'player')]
    private ?NationalTeam $nationalTeam = null;

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

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getCourse(): ?string
    {
        return $this->course;
    }

    public function setCourse(string $course): static
    {
        $this->course = $course;

        return $this;
    }

    public function getGoalsNumber(): ?int
    {
        return $this->goalsNumber;
    }

    public function setGoalsNumber(int $goalsNumber): static
    {
        $this->goalsNumber = $goalsNumber;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getClubTeam(): ?ClubTeam
    {
        return $this->clubTeam;
    }

    public function setClubTeam(?ClubTeam $clubTeam): static
    {
        $this->clubTeam = $clubTeam;

        return $this;
    }

    public function getNationalTeam(): ?NationalTeam
    {
        return $this->nationalTeam;
    }

    public function setNationalTeam(?NationalTeam $nationalTeam): static
    {
        $this->nationalTeam = $nationalTeam;

        return $this;
    }
}
