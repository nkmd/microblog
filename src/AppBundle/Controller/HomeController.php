<?php
/**
 *  контролер HomePage
 */

namespace AppBundle\Controller;

use AppBundle\Service\BlogService as BlogSrv;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\SessionService as SessionSrv;
use AppBundle\Service\HomeService as HomeSrv;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */

    public function createHomePage()
    {

       $banner = 'background: #000 url(/assets/img/bg_banner_2.jpg);';
        $userAuthorized = '';
        $userStatus = '';
        $category = '';
        $message = '';
        $data  = '';

        // Инициализация СЕССИИ
        $session =  new SessionSrv();
        $sessionResult = $session->startSession();

        if ( isset($sessionResult['session_user_login']) && !empty($sessionResult['session_user_login']) &&
             isset($sessionResult['session_user_role'])) {
                $userAuthorized = $sessionResult;
                $userStatus = $sessionResult['session_user_role'];
        }

        // валидация блога(не тр. на буд.)
        $sanitizeData = new HomeSrv();
        $sanitizeDataResult = $sanitizeData->checkData();
        if (!$sanitizeDataResult) {
            $message = '... unknown error !$sanitizeDataResult ';

        } else {

            // отправка в модель блога (статьи,публикации)
            $getArticles = $this->container->get('model_get_articles_home_page');
            $getArticlesResult =  $getArticles -> getArticles($userStatus);
            $data = $getArticlesResult;
//                var_dump($data);die();
        }


        return $this->render('content/home-page.html.twig', array(
            'user_authorized' => $userAuthorized,
            'message' => $message,
            'banner' => $banner,
            'data' => $data,
        ));
    }


}
