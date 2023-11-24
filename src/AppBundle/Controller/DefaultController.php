<?php
/**
 *  контролер HomePage
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\SessionService as SessionSrv;
use AppBundle\Service\HomeService as HomeSrv;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */

    public function createHomePage()
    {
        $test =  new SessionSrv();
        $test2 = $test->setSession();

        $checkData = new HomeSrv();
        $checkResponse = $checkData->checkData();
        if( !$checkResponse ) {
            $message = 'Bad';
            $data  = '';
        } else {
            $message = '';
            $getData = $this->container->get('model_get_articles_home_page');
            $data = $getData->getData();
        }

        return $this->render('content/home-page.html.twig', array(
            'message' => $message,
            'data' => $data,
        ));
    }


}
