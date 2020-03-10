<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FeedItemCategorieRepository")
 */
class FeedItemCategorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FeedItem", inversedBy="categorie")
     */
    private FeedItem $feedItem;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFeedItem(): ?FeedItem
    {
        return $this->feedItem;
    }

    public function setFeedItem(?FeedItem $feedItem): self
    {
        $this->feedItem = $feedItem;

        return $this;
    }
}
