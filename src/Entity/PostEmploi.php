<?php

namespace App\Entity;

use App\Repository\PostEmploiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostEmploiRepository::class)
 */
class PostEmploi
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="postEmplois")
     */
    private $article;

    /**
     * @ORM\Column(type="text")
     */
    private $lettre;



    /**
     * @ORM\Column(type="datetime")
     */
    private $postAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="postEmplois")
     */
    private $userPost;

    /**
     * @ORM\OneToOne(targetEntity=PostReponse::class, mappedBy="post", cascade={"persist", "remove"})
     */
    private $postReponse;

    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getLettre(): ?string
    {
        return $this->lettre;
    }

    public function setLettre(string $lettre): self
    {
        $this->lettre = $lettre;

        return $this;
    }



    public function getPostAt(): ?\DateTimeInterface
    {
        return $this->postAt;
    }

    public function setPostAt(\DateTimeInterface $postAt): self
    {
        $this->postAt = $postAt;

        return $this;
    }

    public function getUserPost(): ?User
    {
        return $this->userPost;
    }

    public function setUserPost(?User $userPost): self
    {
        $this->userPost = $userPost;

        return $this;
    }

    public function getPostReponse(): ?PostReponse
    {
        return $this->postReponse;
    }

    public function setPostReponse(?PostReponse $postReponse): self
    {
        // unset the owning side of the relation if necessary
        if ($postReponse === null && $this->postReponse !== null) {
            $this->postReponse->setPost(null);
        }

        // set the owning side of the relation if necessary
        if ($postReponse !== null && $postReponse->getPost() !== $this) {
            $postReponse->setPost($this);
        }

        $this->postReponse = $postReponse;

        return $this;
    }
}
