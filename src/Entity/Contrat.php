<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ContratRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContratRepository::class)]
#[ApiResource]
class Contrat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'contrats')]
    private $users;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $signatureParent;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $signatureEnfant;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addContrat($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeContrat($this);
        }

        return $this;
    }

    public function getSignatureParent(): ?bool
    {
        return $this->signatureParent;
    }

    public function setSignatureParent(?bool $signatureParent): self
    {
        $this->signatureParent = $signatureParent;

        return $this;
    }

    public function getSignatureEnfant(): ?bool
    {
        return $this->signatureEnfant;
    }

    public function setSignatureEnfant(?bool $signatureEnfant): self
    {
        $this->signatureEnfant = $signatureEnfant;

        return $this;
    }

}
