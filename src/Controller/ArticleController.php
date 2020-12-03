<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
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
        return new Response(sprintf('Future space to show one space article: %s', $slug));

    }


}