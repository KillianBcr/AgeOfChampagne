<?php

namespace App\Entity;

use App\Repository\CarteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: CarteRepository::class)]
#[Vich\Uploadable]
class Carte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private string $name;

    #[ORM\Column(length: 40)]
    private ?string $qrCode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[Vich\UploadableField(mapping: 'card', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private \DateTimeImmutable $updatedAt;

    #[ORM\ManyToOne(inversedBy: 'cartes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Crus $crus = null;

    #[ORM\ManyToOne(inversedBy: 'cartes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cepage $cepage = null;


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }



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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getCrus(): ?Crus
    {
        return $this->crus;
    }

    public function setCrus(?Crus $crus): self
    {
        $this->crus = $crus;

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
