<?php

namespace App\Entity;

use App\Repository\TitreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TitreRepository::class)
 */
class Titre
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
    private $nom_titre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTitre(): ?string
    {
        return $this->nom_titre;
    }

    public function setNomTitre(string $nom_titre): self
    {
        $this->nom_titre = $nom_titre;

        return $this;
    }
}
