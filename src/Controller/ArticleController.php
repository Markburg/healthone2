<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage() {
        return new Response('mooi');
    }

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug) {
        $comments = ['opmerking1', 'opmerking2', 'opmerking3'];
        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'comments' => $comments,
        ]);

    }


}