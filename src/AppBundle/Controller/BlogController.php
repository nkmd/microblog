<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Request;

use AppBundle\Service\BlogService as BlogSrv;
//use AppBundle\Model\BlogModel as BlogMdl;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="blog")
     */
    public function articlesPage()
    {
        //$data='test ARTICLES';

        $instance = new BlogSrv();
        $data = $instance->blogResult();
//        echo $data;
//            die();

        return $this->render('content/blog-page.html.twig', array(
            'data' => $data,
        ));
    }
}



/**
 * // Matches /blog exactly
 *
 * // @Route("/blog", name="blog_list")
 */


/**
 * // Matches /blog/*
 *
 * // @Route("/blog/{slug}", name="blog_show")
 */
