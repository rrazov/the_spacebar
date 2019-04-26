<?php

namespace App\Controller;



use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\MarkdownHelper;
use Doctrine\ORM\EntityManagerInterface;
use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{

    /**
     * @Route("/", name = "app_homepage")
     */
    public function homepage(ArticleRepository $repository)
    {
        /** @var Article $articles */
        $articles = $repository->findAllPublishedOrderedByNewest();

        return $this->render('/article/homepage.html.twig',[
            'articles' => $articles,
        ]);

    }


    /**
     * @Route("/news/{slug}", name="article_show")
     */
    public function show(Article $article){

        $comments = ['ovo je 1. kom','ovo je 2. kom','ovo je 3. kom'];


        return $this->render('article/show.html.twig', [
                'article' => $article,
                'comments' => $comments
            ]);

    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart(Article $article, LoggerInterface $logger, EntityManagerInterface $em)
    {
        $article->incrementHeartCount();
        $em->flush();
        $logger->info('Article is being hearted!');
        return new JsonResponse(['hearts' => $article->getHeartCount()]);
    }
}