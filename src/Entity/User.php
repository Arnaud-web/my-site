<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue'
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;
    private $confirm_password;

    /**
     * @ORM\Column(type="string", length=255,unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $job;

    /**
     * @ORM\OneToMany(targetEntity=UserPhoto::class, mappedBy="user")
     */
    private $userPhotos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adress;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="myFrinds")
     */
    private $Frinds;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="Frinds")
     */
    private $myFrinds;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="userSend")
     */
    private $messagesSend;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="userReceved")
     */
    private $messagesReceved;

    /**
     * @ORM\OneToMany(targetEntity=MessageVu::class, mappedBy="user")
     */
    private $messageVus;

    /**
     * @ORM\OneToOne(targetEntity=Style::class, mappedBy="userStyle", cascade={"persist", "remove"})
     */
    private $style;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="userCreated")
     */
    private $articles;

    /**
     * @ORM\ManyToMany(targetEntity=ArticleVu::class, mappedBy="userVu")
     */
    private $articleVus;

    /**
     * @ORM\ManyToMany(targetEntity=LikeArticle::class, mappedBy="userLike")
     */
    private $likeArticles;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="userComment")
     */
    private $commentaires;

    public function __construct()
    {
        $this->userPhotos = new ArrayCollection();
        $this->Frinds = new ArrayCollection();
        $this->myFrinds = new ArrayCollection();
        $this->messagesSend = new ArrayCollection();
        $this->messagesReceved = new ArrayCollection();
        $this->messageVus = new ArrayCollection();
        $this->articles = new ArrayCollection();
        $this->articleVus = new ArrayCollection();
        $this->likeArticles = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
//        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }  public function getConfirmPassword(): string
    {
        return (string) $this->confirm_password;
    }

    public function setConfirmPassword(string $password): self
    {
        $this->confirm_password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): self
    {
        $this->job = $job;

        return $this;
    }

    /**
     * @return Collection|UserPhoto[]
     */
    public function getUserPhotos(): Collection
    {
        return $this->userPhotos;
    }

    public function addUserPhoto(UserPhoto $userPhoto): self
    {
        if (!$this->userPhotos->contains($userPhoto)) {
            $this->userPhotos[] = $userPhoto;
            $userPhoto->setUser($this);
        }

        return $this;
    }

    public function removeUserPhoto(UserPhoto $userPhoto): self
    {
        if ($this->userPhotos->removeElement($userPhoto)) {
            // set the owning side to null (unless already changed)
            if ($userPhoto->getUser() === $this) {
                $userPhoto->setUser(null);
            }
        }

        return $this;
    }

    public function getPhoto(): ?string
    {
        if($this->photo) {
            return '/upload/images/users/profil/' . $this->photo;
        }
        else{
            return '/uploads/images/users/profil/avatar.png';
        }
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getFrinds(): Collection
    {
        return $this->Frinds;
    }

    public function addFrind(self $frind): self
    {
        if (!$this->Frinds->contains($frind)) {
            $this->Frinds[] = $frind;
        }else{
            $this->Frinds->removeElement($frind);
        }

        return $this;
    }

    public function removeFrind(self $frind): self
    {
        $this->Frinds->removeElement($frind);

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getMyFrind(): Collection
    {
        return $this->myFrinds;
    }

    public function addMyFrind(self $user): self
    {
        if (!$this->myFrinds->contains($user)) {
            $this->myFrinds[] = $user;
            $user->addFrind($this);
        }

        return $this;
    }

    public function removeMyFrind(self $user): self
    {
        if ($this->myFrinds->removeElement($user)) {
            $user->removeFrind($this);
        }

        return $this;
    }

    public function isFrind( $user): bool {
        if ($this->Frinds->contains($user)) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessagesSend(): Collection
    {
        return $this->messagesSend;
    }

    public function getMessagesSendBy($id)
    {

        $messages_t =  $this->messagesSend;
        $messages = new ArrayCollection();
        foreach ($messages_t as $value){
            if ($value->getUserReceved()->getId() == $id){
                $messages->add($value);
            }
        }
        return $messages;
    }

    public function addMessagesSend(Message $messagesSend): self
    {
        if (!$this->messagesSend->contains($messagesSend)) {
            $this->messagesSend[] = $messagesSend;
            $messagesSend->setUserSend($this);
        }

        return $this;
    }

    public function removeMessagesSend(Message $messagesSend): self
    {
        if ($this->messagesSend->removeElement($messagesSend)) {
            // set the owning side to null (unless already changed)
            if ($messagesSend->getUserSend() === $this) {
                $messagesSend->setUserSend(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessagesReceved(): Collection
    {
        return $this->messagesReceved;
    }

    public function addMessagesReceved(Message $messagesReceved): self
    {
        if (!$this->messagesReceved->contains($messagesReceved)) {
            $this->messagesReceved[] = $messagesReceved;
            $messagesReceved->setUserReceved($this);
        }

        return $this;
    }

    public function removeMessagesReceved(Message $messagesReceved): self
    {
        if ($this->messagesReceved->removeElement($messagesReceved)) {
            // set the owning side to null (unless already changed)
            if ($messagesReceved->getUserReceved() === $this) {
                $messagesReceved->setUserReceved(null);
            }
        }

        return $this;
    }

    public function getNewMessage($id){
        $messages  = new ArrayCollection();
        foreach ($this->messagesSend as $ms){
            if ($id == $ms->getUserReceved()->getId()) {
                if($ms->getNew() == false){
                 $messages->add($ms);
                }
            }
        }
        return $messages;
    }

    public function getMessageBy($id){
        $messages  = new ArrayCollection();
        foreach ($this->messagesSend as $ms){
            if ($id == $ms->getUserReceved()->getId()) {

                    $messages->add($ms);

            }
        }
        return $messages;
    }

    public function getAllNewMessage($id){
        $messages  = new ArrayCollection();
        $users = $this->getFrinds();
        $usersN = new ArrayCollection();
        foreach ($users as $user) {
            foreach ($user->messagesSend as $ms) {
                if ($id == $ms->getUserReceved()->getId()) {
                    if ($ms->getNew() == false) {
                        $messages->add($ms);
                        if(!$usersN->contains($user)){
                            $usersN->add($user);
                        }
                    }
                }
            }
        }

        return ['messages'=>$messages,'users'=>$usersN];
    }
    /**
     * @return Collection|MessageVu[]
     */
    public function getMessageVus(): Collection
    {
        return $this->messageVus;
    }

    public function addMessageVu(MessageVu $messageVu): self
    {
        if (!$this->messageVus->contains($messageVu)) {
            $this->messageVus[] = $messageVu;
            $messageVu->setUser($this);
        }

        return $this;
    }

    public function removeMessageVu(MessageVu $messageVu): self
    {
        if ($this->messageVus->removeElement($messageVu)) {
            // set the owning side to null (unless already changed)
            if ($messageVu->getUser() === $this) {
                $messageVu->setUser(null);
            }
        }

        return $this;
    }

    public function getStyle(): ?Style
    {
        if(!$this->style){
            $this->style = new Style();
            $this->style->setNavColor('');
        }
        return $this->style;
    }

    public function setStyle(?Style $style): self
    {
        // unset the owning side of the relation if necessary
        if ($style === null && $this->style !== null) {
            $this->style->setUserStyle(null);
        }

        // set the owning side of the relation if necessary
        if ($style !== null && $style->getUserStyle() !== $this) {
            $style->setUserStyle($this);
        }

        $this->style = $style;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setUserCreated($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getUserCreated() === $this) {
                $article->setUserCreated(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ArticleVu[]
     */
    public function getArticleVus(): Collection
    {
        return $this->articleVus;
    }

    public function addArticleVu(ArticleVu $articleVu): self
    {
        if (!$this->articleVus->contains($articleVu)) {
            $this->articleVus[] = $articleVu;
            $articleVu->addUserVu($this);
        }

        return $this;
    }

    public function removeArticleVu(ArticleVu $articleVu): self
    {
        if ($this->articleVus->removeElement($articleVu)) {
            $articleVu->removeUserVu($this);
        }

        return $this;
    }

    /**
     * @return Collection|LikeArticle[]
     */
    public function getLikeArticles(): Collection
    {
        return $this->likeArticles;
    }

    public function addLikeArticle(LikeArticle $likeArticle): self
    {
        if (!$this->likeArticles->contains($likeArticle)) {
            $this->likeArticles[] = $likeArticle;
            $likeArticle->addUserLike($this);
        }

        return $this;
    }

    public function removeLikeArticle(LikeArticle $likeArticle): self
    {
        if ($this->likeArticles->removeElement($likeArticle)) {
            $likeArticle->removeUserLike($this);
        }

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setUserComment($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getUserComment() === $this) {
                $commentaire->setUserComment(null);
            }
        }

        return $this;
    }
}
