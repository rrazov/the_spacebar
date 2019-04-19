<?php

namespace App\Controller;



use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    /**
     * @Route("/")
     */

    public function homepage(){

        return new Response("tako je mrki");

    }

    /**
     * @Route("/news/{id}")
     */
    public function show($id){

        $comments = ['ovo je 1. kom','ovo je 2. kom','ovo je 3. kom'];
        return $this->render('/article/show.html.twig', [
                'title' => 'ovo je title',
                'comments' => $comments
            ]);

    }
}