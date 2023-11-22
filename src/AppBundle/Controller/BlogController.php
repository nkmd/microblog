<?php
/**
 *  контролер BlogPage
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Service\BlogService as BlogSrv;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="blog")
     */

    public function createBlogPage()
    {
        $checkData = new BlogSrv();
        $checkResponse = $checkData->checkData();
        if( !$checkResponse ) {
            $message = 'Bad';
            $data  = '';
        } else {
            $message = '';
            $getData = $this->container->get('model_get_articles');
            $data = $getData->getData();
        }

        return $this->render('content/blog-page.html.twig', array(
            'message' => $message,
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
