<?php


namespace App\Services;


use App\Entity\CompanyFeed;
use App\Entity\FeedItem;
use App\Entity\FeedItemCategorie;
use Doctrine\ORM\EntityManagerInterface;
use FeedIo\FeedInterface;

class FeedService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function isFeedModified(\DateTimeInterface $lastModified, \DateTimeInterface $lastModifiedDb): bool
    {
        return $lastModified <=> $lastModifiedDb;
    }

    public function saveFeedIfNotExists(FeedInterface $feedIo): CompanyFeed
    {
        $feedDb = $this->em->getRepository(CompanyFeed::class)->findOneBy(['title' => $feedIo->getTitle()]);

        if (empty($feedDb)) {

            $feedDb = new CompanyFeed();

            $feedDb->setTitle($feedIo->getTitle());
            $feedDb->setDescription($feedIo->getDescription());
            $feedDb->setLastModified($feedIo->getLastModified());

            $this->em->persist($feedDb);

            foreach ($feedIo as $feedItemIo) {
                $feedItem = new FeedItem();


                $feedItem->setTitle($feedItemIo->getTitle());
                $feedItem->setLastModified($feedItemIo->getLastModified());
                $feedItem->setDescription(explode('...',$feedItemIo->getDescription())[0]);
                $feedItem->setAuthor($feedItemIo->getAuthor()->getName());
                $feedItem->setLink($feedItemIo->getLink());
                $feedItem->setFeed($feedDb);

                foreach ($feedItemIo->getCategories() as $category) {

                    $categorieDB = $this->em->getRepository(FeedItemCategorie::class)->findOneBy(['title' => $category->getTerm()]);

                    if (empty($categorieDB)) {
                        $categorieDB = new FeedItemCategorie();
                        $categorieDB->setTitle($category->getTerm());
                        $categorieDB->setFeedItem($feedItem);
                        $this->em->persist($categorieDB);
                    }
                    $feedItem->addCategorie($categorieDB);

                }

                $this->em->persist($feedItem);
            }

            $this->em->flush();
        }
        return $feedDb;
    }

}