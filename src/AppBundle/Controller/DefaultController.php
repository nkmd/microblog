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
        $data='home data';
        $data2='home data2';

        return $this->render('content/home-page.html.twig', array(
            'data' => $data,
            'data2' => $data2,
        ));
    }
}
