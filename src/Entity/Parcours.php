<?php

namespace App\Entity;

use App\Repository\ParcoursRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParcoursRepository::class)
 */
class Parcours
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
    private $titre_parcours;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu_parcours;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date_parcours;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duree_parcours;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreParcours(): ?string
    {
        return $this->titre_parcours;
    }

    public function setTitreParcours(string $titre_parcours): self
    {
        $this->titre_parcours = $titre_parcours;

        return $this;
    }

    public function getContenuParcours(): ?string
    {
        return $this->contenu_parcours;
    }

    public function setContenuParcours(string $contenu_parcours): self
    {
        $this->contenu_parcours = $contenu_parcours;

        return $this;
    }

    public function getDateParcours(): ?string
    {
        return $this->date_parcours;
    }

    public function setDateParcours(string $date_parcours): self
    {
        $this->date_parcours = $date_parcours;

        return $this;
    }

    public function getDureeParcours(): ?string
    {
        return $this->duree_parcours;
    }

    public function setDureeParcours(string $duree_parcours): self
    {
        $this->duree_parcours = $duree_parcours;

        return $this;
    }
}
