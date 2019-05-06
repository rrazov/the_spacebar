<?php
/**
 * Created by PhpStorm.
 * User: razov
 * Date: 25.04.19.
 * Time: 09:44
 */

namespace App\Controller;


use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ArticleAdminController
 * @package App\Controller
 * @IsGranted("ROLE_ADMIN")
 */
class ArticleAdminController extends AbstractController
{

    /**
     * @Route("/admin/article/new", name="admin_article_new")
     */
    public function new(EntityManagerInterface $entityManager, Request $request)
    {

        $form = $this->createForm(ArticleFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            /** @var Article $article */
            $article = $form->getData();
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success', 'Article created!');

            return $this->redirectToRoute('admin_article_list');



        }
        return $this->render('article_admin/new.html.twig',[
            'articleForm' => $form->createView(),
        ]);

    }

    /**
     * @Route("/admin/article/{id}/edit", name="admin_article_edit")
     */
    public function edit(Article $article, Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Article $article */
            $article = $form->getData();
            $entityManager->persist($article);
            $entityManager->flush();
            $this->addFlash('success', 'Article Updated!');
            return $this->redirectToRoute('admin_article_edit', [
                'id' => $article->getId(),
            ]);
        }
        return $this->render('article_admin/edit.html.twig', [
            'articleForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/article", name="admin_article_list")
     */
    public function list(ArticleRepository $articleRepo){
        $articles = $articleRepo->findAll();

        return $this->render('article_admin/list.html.twig', [
            'articles' => $articles
        ]);

    }

}