<?php

namespace App\Entity;

use App\Repository\EnfantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnfantRepository::class)]
class Enfant extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $cagnotte;

    #[ORM\ManyToOne(targetEntity: UParent::class, inversedBy: 'enfants')]
    private $uParent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCagnotte(): ?int
    {
        return $this->cagnotte;
    }

    public function setCagnotte(int $cagnotte): self
    {
        $this->cagnotte = $cagnotte;

        return $this;
    }

    public function getUParent(): ?UParent
    {
        return $this->uParent;
    }

    public function setUParent(?UParent $uParent): self
    {
        $this->uParent = $uParent;

        return $this;
    }
}
