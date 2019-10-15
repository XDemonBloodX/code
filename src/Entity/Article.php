<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @UniqueEntity(
 * fields={"libelle"},
 * message="Le libelle est déjà utilisé"
 * )
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, minMessage="Votre libelle doit faire minimum 5 caractères")
     * @Assert\Length(max=50, maxMessage="Votre libelle doit faire maximum 50 caractères")
     * @Assert\NotBlank(message="Veuillez renseigner votre libelle")
     */
    private $libelle;

    /**
    * @ORM\Column(type="decimal", precision=5, scale=2)
    * @Assert\NotBlank(message="Veuillez renseigner le prix de l'article")
    */
    private $prix;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(min=10, minMessage="Votre description doit faire minimum 10 caractères")
     * @Assert\Length(max=200, maxMessage="Votre description doit faire maximum 200 caractères")
     * @Assert\NotBlank(message="Veuillez renseigner votre description")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
