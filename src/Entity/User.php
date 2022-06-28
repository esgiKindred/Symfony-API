<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]
#[ApiFilter(PropertyFilter::class)]
#[ApiFilter(SearchFilter::class, properties: ['parent' => 'exact'])]
#[ApiFilter(SearchFilter::class, properties: ['enfants' => 'exact'])]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $lastName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $firstName;

    #[ORM\ManyToMany(targetEntity: Contrat::class, inversedBy: 'users')]
    private $contrats;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'enfants', cascade: ['persist'])]
    private $parent;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class, cascade: ['persist'])]
    private $enfants;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $kins = 0;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $pointsBonus = 0;

    #[ORM\ManyToMany(targetEntity: Recompense::class, mappedBy: 'users')]
    private $recompenses;

    #[ORM\ManyToMany(targetEntity: Mission::class, mappedBy: 'user')]
    private $missions;

    public function __construct()
    {
        $this->contrats = new ArrayCollection();
        $this->enfants = new ArrayCollection();
        $this->recompenses = new ArrayCollection();
        $this->missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return Collection|Contrat[]
     */
    public function getContrats(): Collection
    {
        return $this->contrats;
    }

    public function addContrat(Contrat $contrat): self
    {
        if (!$this->contrats->contains($contrat)) {
            $this->contrats[] = $contrat;
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        $this->contrats->removeElement($contrat);

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getEnfants(): Collection
    {
        return $this->enfants;
    }

    public function addEnfant(self $enfant): self
    {
        if (!$this->enfants->contains($enfant)) {
            $this->enfants[] = $enfant;
            $enfant->setParent($this);
        }

        return $this;
    }

    public function removeEnfant(self $enfant): self
    {
        if ($this->enfants->removeElement($enfant)) {
            // set the owning side to null (unless already changed)
            if ($enfant->getParent() === $this) {
                $enfant->setParent(null);
            }
        }

        return $this;
    }

    public function getKins(): ?int
    {
        return $this->kins;
    }

    public function setKins(?int $kins): self
    {
        $this->kins = $kins;

        return $this;
    }

    public function getPointsBonus(): ?int
    {
        return $this->pointsBonus;
    }

    public function setPointsBonus(?int $pointsBonus): self
    {
        $this->pointsBonus = $pointsBonus;

        return $this;
    }

    /**
     * @return Collection<int, Recompense>
     */
    public function getRecompenses(): Collection
    {
        return $this->recompenses;
    }

    public function addRecompense(Recompense $recompense): self
    {
        if (!$this->recompenses->contains($recompense)) {
            $this->recompenses[] = $recompense;
            $recompense->addUser($this);
        }

        return $this;
    }

    public function removeRecompense(Recompense $recompense): self
    {
        if ($this->recompenses->removeElement($recompense)) {
            $recompense->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Mission>
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
            $mission->addUser($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            $mission->removeUser($this);
        }

        return $this;
    }


}
