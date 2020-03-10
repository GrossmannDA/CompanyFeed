<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FeedItemRepository")
 */
class FeedItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $author;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $title;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private string $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $lastModified;

    /**
     * @ORM\ManyToOne(targetEntity="CompanyFeed", inversedBy="feedItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private CompanyFeed $feed;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FeedItemCategorie", mappedBy="feedItem")
     */
    private  $categorie;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $link;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

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

    public function getLastModified(): ?\DateTimeInterface
    {
        return $this->lastModified;
    }

    public function setLastModified(\DateTimeInterface $lastModified): self
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    public function getFeed(): ?CompanyFeed
    {
        return $this->feed;
    }

    public function setFeed(?CompanyFeed $feed): self
    {
        $this->feed = $feed;

        return $this;
    }

    /**
     * @return Collection|FeedItemCategorie[]
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(FeedItemCategorie $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
            $categorie->setFeedItem($this);
        }

        return $this;
    }

    public function removeCategorie(FeedItemCategorie $categorie): self
    {
        if ($this->categorie->contains($categorie)) {
            $this->categorie->removeElement($categorie);
            // set the owning side to null (unless already changed)
            if ($categorie->getFeedItem() === $this) {
                $categorie->setFeedItem(null);
            }
        }

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }
}
