<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\HasLifecycleCallbacks]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['id' => 'exact', 'email' => 'exact'])]
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
    private $firstName;

    #[ORM\Column(type: 'string')]
    private $lastName;

    #[ORM\Column(type: 'integer')]
    private $dailyConsumption;

    #[ORM\Column(type: 'integer')]
    private $cigarettesPerPack;

    #[ORM\Column(type: 'float')]
    private $packPrice;

    #[ORM\Column(type: 'string')]
    private $password;

    #[SerializedName("password")]
    private $plainPassword;

    #[ORM\Column(type: 'datetime')]
    private $lastTime;

    #[ORM\Column(type: 'datetime')]
    private $creationDate;

    #[ORM\PrePersist]
    public function onPrePersist() :void
    {
        $this->creationDate = new \DateTime();
        $this->lastTime = new \DateTime();

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


    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }


    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getDailyConsumption(): ?int
    {
        return $this->dailyConsumption;
    }

    public function setDailyConsumption(int $dailyConsumption): self
    {
        $this->dailyConsumption = $dailyConsumption;

        return $this;
    }


    public function getCigarettesPerPack(): ?int
    {
        return $this->cigarettesPerPack;
    }

    public function setCigarettesPerPack(int $cigarettesPerPack): self
    {
        $this->cigarettesPerPack = $cigarettesPerPack;

        return $this;
    }

    public function getPackPrice(): ?float
    {
        return $this->packPrice;
    }

    public function setPackPrice(float $packPrice): self
    {
        $this->packPrice = $packPrice;

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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
         $this->plainPassword = null;
    }

    public function getLastTime(): \DateTimeInterface
    {
        return $this->lastTime;
    }

    public function setLastTime(\DateTimeInterface $lastTime): self
    {
        $this->lastTime = $lastTime;

        return $this;
    }

    public function getCreationDate(): \DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }
}
