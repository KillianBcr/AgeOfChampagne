<?php

namespace App\Entity;

use App\Repository\CarteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarteRepository::class)]
class Carte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $qrCode = null;

    #[ORM\Column(length: 255)]
    private ?string $imageCarte = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQrCode(): ?string
    {
        return $this->qrCode;
    }

    public function setQrCode(string $qrCode): self
    {
        $this->qrCode = $qrCode;

        return $this;
    }

    public function getImageCarte(): ?string
    {
        return $this->imageCarte;
    }

    public function setImageCarte(string $imageCarte): self
    {
        $this->imageCarte = $imageCarte;

        return $this;
    }
}
