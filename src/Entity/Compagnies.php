<?php

namespace App\Entity;

use App\Repository\CompagniesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompagniesRepository::class)]
class Compagnies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $full_name = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $http = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $compagnie_desc = null;

    public function __construct()
    {
        $this->advertisements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function setFullName(string $full_name): self
    {
        $this->full_name = $full_name;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getHttp(): ?string
    {
        return $this->http;
    }

    public function setHttp(?string $http): self
    {
        $this->http = $http;

        return $this;
    }

    public function getCompagnieDesc(): ?string
    {
        return $this->compagnie_desc;
    }

    public function setCompagnieDesc(?string $compagnie_desc): self
    {
        $this->compagnie_desc = $compagnie_desc;

        return $this;
    }
}
