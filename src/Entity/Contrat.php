<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContratRepository::class)]
class Contrat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: UParent::class, inversedBy: 'contrats')]
    #[ORM\JoinColumn(nullable: false)]
    private $Autheur;

    #[ORM\Column(type: 'boolean')]
    private $signature;

    #[ORM\OneToMany(mappedBy: 'contrat', targetEntity: categorie::class)]
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAutheur(): ?UParent
    {
        return $this->Autheur;
    }

    public function setAutheur(?UParent $Autheur): self
    {
        $this->Autheur = $Autheur;

        return $this;
    }

    public function getSignature(): ?bool
    {
        return $this->signature;
    }

    public function setSignature(bool $signature): self
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * @return Collection|categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setContrat($this);
        }

        return $this;
    }

    public function removeCategory(categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getContrat() === $this) {
                $category->setContrat(null);
            }
        }

        return $this;
    }
}
