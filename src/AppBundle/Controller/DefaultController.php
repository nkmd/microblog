<?php
/**
 *  контролер HomePage
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\HomeService as HomeSrv;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */

    public function createHomePage()
    {
        $checkData = new HomeSrv();
        $checkResponse = $checkData->checkData();
        if( !$checkResponse ) {
            $message = 'Bad';
            $data  = '';
        } else {
            $message = '';
            $getData = $this->container->get('model_get_user');
            $data = $getData->getData();
        }

        return $this->render('content/home-page.html.twig', array(
            'message' => $message,
            'data' => $data,
        ));
    }


}
