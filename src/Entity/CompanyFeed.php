<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FeedIo\FeedInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FeedRepository")
 */
class CompanyFeed
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
     * @ORM\OneToMany(targetEntity="App\Entity\FeedItem", mappedBy="feed")
     */
    private $feedItems;

    public function __construct()
    {
        $this->feedItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
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

    /**
     * @return Collection|FeedItem[]
     */
    public function getFeedItems(): Collection
    {
        return $this->feedItems;
    }

    public function addFeedItem(FeedItem $feedItem): self
    {
        if (!$this->feedItems->contains($feedItem)) {
            $this->feedItems[] = $feedItem;
            $feedItem->setFeed($this);
        }

        return $this;
    }

    public function removeFeedItem(FeedItem $feedItem): self
    {
        if ($this->feedItems->contains($feedItem)) {
            $this->feedItems->removeElement($feedItem);
            // set the owning side to null (unless already changed)
            if ($feedItem->getFeed() === $this) {
                $feedItem->setFeed(null);
            }
        }

        return $this;
    }
}
