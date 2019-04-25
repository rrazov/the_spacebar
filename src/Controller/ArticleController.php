<?php

namespace App\Controller;



use App\Entity\Article;
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

    public function homepage(){

        return $this->render('/article/homepage.html.twig');

    }

    /**
     * @Route("/news/{slug}", name="article_show")
     */
    public function show($slug, EntityManagerInterface $entityManager){



        $repository = $entityManager->getRepository(Article::class);
        /** @var Article $article */
        $article = $repository->findOneBy(['slug' => $slug]);

        if (!$article){
            throw $this->createNotFoundException(sprintf('No article for slug "%s"', $slug));
        }


        $comments = ['ovo je 1. kom','ovo je 2. kom','ovo je 3. kom'];


        return $this->render('article/show.html.twig', [
                'article' => $article,
                'comments' => $comments
            ]);

    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {
        $logger->info('Article is being hearted');
        return $this->json(['hearts' => rand(5, 100)]);
    }
}