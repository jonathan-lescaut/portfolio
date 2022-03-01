<?php

namespace App\Entity;

use App\Repository\RealisationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RealisationRepository::class)
 */
class Realisation
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
    private $titre_realisation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image_realisation;

    /**
     * @ORM\Column(type="text")
     */
    private $resume_realisation;

    /**
     * @ORM\Column(type="text")
     */
    private $fonctionnalite_realisation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $site_realistation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $git_realisation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreRealisation(): ?string
    {
        return $this->titre_realisation;
    }

    public function setTitreRealisation(string $titre_realisation): self
    {
        $this->titre_realisation = $titre_realisation;

        return $this;
    }

    public function getImageRealisation(): ?string
    {
        return $this->image_realisation;
    }

    public function setImageRealisation(string $image_realisation): self
    {
        $this->image_realisation = $image_realisation;

        return $this;
    }

    public function getResumeRealisation(): ?string
    {
        return $this->resume_realisation;
    }

    public function setResumeRealisation(string $resume_realisation): self
    {
        $this->resume_realisation = $resume_realisation;

        return $this;
    }

    public function getFonctionnaliteRealisation(): ?string
    {
        return $this->fonctionnalite_realisation;
    }

    public function setFonctionnaliteRealisation(string $fonctionnalite_realisation): self
    {
        $this->fonctionnalite_realisation = $fonctionnalite_realisation;

        return $this;
    }

    public function getSiteRealistation(): ?string
    {
        return $this->site_realistation;
    }

    public function setSiteRealistation(string $site_realistation): self
    {
        $this->site_realistation = $site_realistation;

        return $this;
    }

    public function getGitRealisation(): ?string
    {
        return $this->git_realisation;
    }

    public function setGitRealisation(string $git_realisation): self
    {
        $this->git_realisation = $git_realisation;

        return $this;
    }
}
