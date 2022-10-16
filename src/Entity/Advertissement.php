<?php

namespace App\Entity;

use App\Repository\AdvertissementRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvertissementRepository::class)]
class Advertissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $job = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $job_desc = null;

    #[ORM\Column(length: 20)]
    private ?string $date = null;

    #[ORM\ManyToOne(inversedBy: 'advertisements')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $id_u = null;

    #[ORM\ManyToOne(inversedBy: 'myAds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_owner;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getJobDesc(): ?string
    {
        return $this->job_desc;
    }

    public function setJobDesc(string $job_desc): self
    {
        $this->job_desc = $job_desc;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getIdU(): ?Compagnies
    {
        return $this->id_u;
    }

    /**
     * @param User|null $id_u
     */
    public function setIdU(?User $id_u): void
    {
        $this->id_u = $id_u;
    }

    /**
     * @return User|null
     */
    public function getIdOwner(): ?User
    {
        return $this->id_owner;
    }

    /**
     * @param User|null $id_owner
     */
    public function setIdOwner(?User $id_owner): void
    {
        $this->id_owner = $id_owner;
    }

    /**
     * @return string
     */
    public function getRelease()
    {
        return $this->release;
    }

    /**
     * @param string $release
     */
    public function setRelease($release): void
    {
        $this->release = $release;
    }

}
