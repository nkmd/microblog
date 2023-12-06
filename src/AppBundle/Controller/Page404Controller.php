<?php
/**
 *  контролер 404Page
 */
namespace AppBundle\Controller;

use AppBundle\Service\SessionService as SessionSrv;
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
        $userAuthorized = '';

        // Инициализация СЕССИИ
        $session =  new SessionSrv();
        $sessionResult = $session->startSession();

        if ( isset($sessionResult['session_user_login']) && !empty($sessionResult['session_user_login']) ) {
            $userAuthorized = $sessionResult;
        }


        return $this->render('content/404-page.html.twig', array(
            'user_authorized' => $userAuthorized,
            'message' => $message,
            'data'    => $data,
        ));
    }



}
