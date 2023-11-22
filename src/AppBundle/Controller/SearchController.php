<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Request;

use AppBundle\Service\SearchService as SearchSrv;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="search")
     */
    public function articlesPage()
    {
        $data='SEARCH test';

        return $this->render('content/search-page.html.twig', array(
            'data' => $data,
        ));
    }

}

