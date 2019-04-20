<?php

namespace App\Controller;



use Psr\Log\LoggerInterface;
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
     * @Route("/news/{id}", name="article_show")
     */
    public function show($id){

        $comments = ['ovo je 1. kom','ovo je 2. kom','ovo je 3. kom'];

        return $this->render('/article/show.html.twig', [
                'title' => 'ovo je title',
                'id' => $id,
                'comments' => $comments
            ]);

    }

    /**
     * @Route("/news/{id}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($id, LoggerInterface $logger)
    {
        $logger->info('Article is being hearted');
        return $this->json(['hearts' => rand(5, 100)]);
    }
}