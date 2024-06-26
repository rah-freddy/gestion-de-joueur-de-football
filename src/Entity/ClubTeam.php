<?php

namespace App\Entity;

use App\Repository\ClubTeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClubTeamRepository::class)]
class ClubTeam
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Player::class, mappedBy: 'clubTeam', cascade: ['remove'])]
    private Collection $player;

    public function __construct()
    {
        $this->player = new ArrayCollection();
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

    /**
     * @return Collection<int, Player>
     */
    public function getPlayer(): Collection
    {
        return $this->player;
    }

    public function addPlayer(Player $player): static
    {
        if (!$this->player->contains($player)) {
            $this->player->add($player);
            $player->setClubTeam($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): static
    {
        if ($this->player->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getClubTeam() === $this) {
                $player->setClubTeam(null);
            }
        }

        return $this;
    }
}
