<?php

namespace App\Entity;

use App\Repository\PostReponseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostReponseRepository::class)
 */
class PostReponse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    private $reponse;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEntretien;

    /**
     * @ORM\OneToOne(targetEntity=PostEmploi::class, inversedBy="postReponse", cascade={"persist", "remove"})
     */
    private $post;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getDateEntretien(): ?\DateTimeInterface
    {
        return $this->dateEntretien;
    }

    public function setDateEntretien(?\DateTimeInterface $dateEntretien): self
    {
        $this->dateEntretien = $dateEntretien;

        return $this;
    }

    public function getPost(): ?PostEmploi
    {
        return $this->post;
    }

    public function setPost(?PostEmploi $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getStatu(): ?string
    {
        return $this->statu;
    }

    public function setStatu(string $statu): self
    {
        $this->statu = $statu;

        return $this;
    }
}
