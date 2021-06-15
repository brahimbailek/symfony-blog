<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    /**
     * @Route("/test/{nom}", name="test")
     */
    public function index(string $nom): Response
    {
        $taille=strlen($nom);

        return $this->render('test/index.html.twig', [
            'nom' => $nom,
            'taille' => $taille,
        ]);
    }

    /**
     * @Route("/nv-page/{num}/{autre}", name="nv-page")
     */
    public function nvPage(int $num, int $autre): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>bonjour '. $num.'/'.$autre.' , your Lucky number is: ' . $number . '</body></html>'
        );
    }

    /**
     * @Route("/nouvelle-action/{nom}", name="nouvelle-action")
     */
    public function nvAction(string $nom): Response
    {
                return new Response(
            '<html><body><h1>Bonjour '.$nom.'</h1></body></html>'
        );
    }
}
