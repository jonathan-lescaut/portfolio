<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 */
class Competence
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
    private $titre_competence;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu_competence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreCompetence(): ?string
    {
        return $this->titre_competence;
    }

    public function setTitreCompetence(string $titre_competence): self
    {
        $this->titre_competence = $titre_competence;

        return $this;
    }

    public function getContenuCompetence(): ?string
    {
        return $this->contenu_competence;
    }

    public function setContenuCompetence(string $contenu_competence): self
    {
        $this->contenu_competence = $contenu_competence;

        return $this;
    }
}
