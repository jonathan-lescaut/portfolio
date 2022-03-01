<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
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
    private $titre_contact;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu_contact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cv_contact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail_contact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cv_image_contact;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreContact(): ?string
    {
        return $this->titre_contact;
    }

    public function setTitreContact(string $titre_contact): self
    {
        $this->titre_contact = $titre_contact;

        return $this;
    }

    public function getContenuContact(): ?string
    {
        return $this->contenu_contact;
    }

    public function setContenuContact(string $contenu_contact): self
    {
        $this->contenu_contact = $contenu_contact;

        return $this;
    }

    public function getCvContact(): ?string
    {
        return $this->cv_contact;
    }

    public function setCvContact(string $cv_contact): self
    {
        $this->cv_contact = $cv_contact;

        return $this;
    }

    public function getMailContact(): ?string
    {
        return $this->mail_contact;
    }

    public function setMailContact(string $mail_contact): self
    {
        $this->mail_contact = $mail_contact;

        return $this;
    }

    public function getCvImageContact(): ?string
    {
        return $this->cv_image_contact;
    }

    public function setCvImageContact(string $cv_image_contact): self
    {
        $this->cv_image_contact = $cv_image_contact;

        return $this;
    }
}
