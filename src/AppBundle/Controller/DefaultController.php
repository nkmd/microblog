<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homePage()
    {
        $number='111';
        $text_var='22';

        return $this->render('content/home-page.html.twig', array(
            'number' => $number,
            'text_var' => $text_var,
        ));
    }
}
