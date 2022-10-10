<?php

namespace App\Entity;

use App\Repository\AdvertissementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvertissementRepository::class)]
class Advertissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $job = null;

    #[ORM\Column(length: 255)]
    private ?string $job_desc = null;

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
}
