<?php
/**
 *  контролер 404Page
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Page404Controller extends Controller
{
    /**
     * @Route("/404", name="404_page")
     */

    public function create404Page()
    {

        $message = '404 page';
        $data = '';

        return $this->render('content/404-page.html.twig', array(
            'message' => $message,
            'data'    => $data,
        ));
    }



}
