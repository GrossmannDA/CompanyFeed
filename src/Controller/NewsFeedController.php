<?php


namespace App\Controller;


use App\Enums\UrlEnum;
use App\Services\FeedService;
use FeedIo\FeedIo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NewsFeedController extends AbstractController
{
    /**
     * @Route("/", name="feed")
     */
    public function index(FeedIo $feedIo, FeedService $feedService)
    {
        $feedIo = $feedIo->read(UrlEnum::FeedURL)->getFeed();

        $feed = $feedService->saveFeedIfNotExists($feedIo);

        if ($feedService->isFeedModified($feedIo->getLastModified(), $feed->getLastModified())) {
            //TODO Update Feed
        }

        return $this->render('feed.html.twig', ['feed' => $feed]);
    }

}