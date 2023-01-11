<?php

namespace App\Entity;

use App\Repository\CrusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CrusRepository::class)]
class Crus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'crus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cepage $cepage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCepage(): ?Cepage
    {
        return $this->cepage;
    }

    public function setCepage(?Cepage $cepage): self
    {
        $this->cepage = $cepage;

        return $this;
    }

}
