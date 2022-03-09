<?php

namespace App\Entity;

use App\Repository\TechnologieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TechnologieRepository::class)
 */
class Technologie
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
    private $nom_techologie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logo_techologie;

    /**
     * @ORM\ManyToMany(targetEntity=Realisation::class, inversedBy="technologies")
     */
    private $Realisation;

    public function __construct()
    {
        $this->Realisation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTechologie(): ?string
    {
        return $this->nom_techologie;
    }

    public function setNomTechologie(string $nom_techologie): self
    {
        $this->nom_techologie = $nom_techologie;

        return $this;
    }

    public function getLogoTechologie(): ?string
    {
        return $this->logo_techologie;
    }

    public function setLogoTechologie(string $logo_techologie): self
    {
        $this->logo_techologie = $logo_techologie;

        return $this;
    }

    /**
     * @return Collection<int, Realisation>
     */
    public function getRealisation(): Collection
    {
        return $this->Realisation;
    }

    public function addRealisation(Realisation $realisation): self
    {
        if (!$this->Realisation->contains($realisation)) {
            $this->Realisation[] = $realisation;
        }

        return $this;
    }

    public function removeRealisation(Realisation $realisation): self
    {
        $this->Realisation->removeElement($realisation);

        return $this;
    }
}
