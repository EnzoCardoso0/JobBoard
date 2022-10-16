<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'Un compte est déjà associé à cette e-mail')]
#[ApiResource]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 40)]
    private string $name;

    #[ORM\Column(length: 5)]
    private string $cp;

    #[ORM\Column(length: 60)]
    private string $adress;

    #[ORM\Column(length: 10)]
    private string $tel;

    #[ORM\Column]
    private bool $isCompagny = true;

    #[ORM\ManyToMany(targetEntity: 'Advertissement', inversedBy: 'users')]
    #[ORM\JoinTable(name: 'mesOffres')]
    private ?Collection $id_ad = null;

    #[ORM\OneToMany(mappedBy: 'id_owner', targetEntity: Advertissement::class)]
    private Collection $myAds;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

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

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCP(): string
    {
        return $this->cp;
    }

    public function setCP(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getAdress(): string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

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

    /**
     * @return Collection
     */
    public function getMyAds(): Collection
    {
        return $this->myAds;
    }

    /**
     * @param Collection $myAds
     */
    public function setMyAds(Collection $myAds): void
    {
        $this->myAds = $myAds;
    }

    /**
     * @param bool $isCompagny
     */
    public function setIsCompagny(bool $isCompagny): void
    {
        $this->isCompagny = $isCompagny;
    }

    /**
     * @return bool
     */
    public function getIsCompagny(): bool
    {
        return $this->isCompagny;
    }

    /**
     * @return Collection|null
     */
    public function getIdAd(): ?Collection
    {
        return $this->id_ad;
    }

    /**
     * @param Collection|null $id_ad
     */
    public function setIdAd(?Collection $id_ad): void
    {
        $this->id_ad = $id_ad;
    }

    public function addIdAd(?Advertissement $id_ad){
        $this->id_ad[] = $id_ad;
    }
}
