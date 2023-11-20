<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArticlesController extends Controller
{
    /**
     * @Route("/articles", name="articles")
     */
    public function articlesPage()
    {
        $test='test articles';

        return $this->render('content/articles-page.html.twig', array(
            'test' => $test,
        ));
    }
}
