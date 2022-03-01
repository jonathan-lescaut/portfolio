<?php

namespace App\Entity;

use App\Repository\PresentationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PresentationRepository::class)
 */
class Presentation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo_presentation;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu_presentation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhotoPresentation(): ?string
    {
        return $this->photo_presentation;
    }

    public function setPhotoPresentation(string $photo_presentation): self
    {
        $this->photo_presentation = $photo_presentation;

        return $this;
    }

    public function getContenuPresentation(): ?string
    {
        return $this->contenu_presentation;
    }

    public function setContenuPresentation(string $contenu_presentation): self
    {
        $this->contenu_presentation = $contenu_presentation;

        return $this;
    }
}
