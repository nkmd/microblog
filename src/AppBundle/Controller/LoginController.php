<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function articlesPage()
    {
        $data='LOGIN test';;

        return $this->render('content/login-page.html.twig', array(
            'data' => $data,
        ));
    }
}
