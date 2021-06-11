<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(ArticleRepository $repoArticle): Response
    {
        $articles=$repoArticle->findAll();

        return $this->render('home/index.html.twig', [
            'articles' => $articles
        ]);
    }
}
