<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MissionRepository::class)]
#[ApiResource]
class Mission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'integer')]
    private $kins;

    #[ORM\Column(type: 'string', length: 255)]
    private $etat;

    #[ORM\Column(type: 'text', nullable: true)]
    private $evaluation;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'missions')]
    private $categorie;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $autoEvaluation;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'missions')]
    private $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getKins(): ?int
    {
        return $this->kins;
    }

    public function setKins(int $kins): self
    {
        $this->kins = $kins;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getEvaluation(): ?string
    {
        return $this->evaluation;
    }

    public function setEvaluation(?string $evaluation): self
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getAutoEvaluation(): ?string
    {
        return $this->autoEvaluation;
    }

    public function setAutoEvaluation(?string $autoEvaluation): self
    {
        $this->autoEvaluation = $autoEvaluation;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }
}
