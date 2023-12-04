<?php
/**
 *  контролер VipPage
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\SessionService as SessionSrv;
use AppBundle\Service\CategoryService as CategorySrv;
use AppBundle\Service\VipService as VipSrv;

class VipController extends Controller
{
    /**
     * @Route("/vip", name="vip")
     */

    public function createBlogPage()
    {
        $userAuthorized = '';
        $userStatus = '';
        $getCategoryList ='';
        $categoryId = '';
        $message = '';
        $data  = '';

        // Инициализация СЕССИИ
        $session =  new SessionSrv();
        $sessionResult = $session->startSession();

        // #### ВТОРИЗОВАН. ####
        if ( isset($sessionResult['session_user_login']) && !empty($sessionResult['session_user_login']) &&
            isset($sessionResult['session_user_role']) && !empty($sessionResult['session_user_role']) ){
            $userAuthorized = $sessionResult;
            $userStatus = $sessionResult['session_user_role'];


            if(isset($_GET['filter']) && $_GET['filter'] != 0) {
                // валидация категории
                $categoryId = $_GET['filter'];
                $sanitizeCategory = new VipSrv();
                $sanitizeCategoryResult = $sanitizeCategory->checkData($categoryId);

                // отправка в модель категорий
                $getCategory = $this->container->get('model_get_category');
                $getCategoryList   =  $getCategory -> getCategoryList();
                $getCategoryResult =  $getCategory -> getCategoryById($sanitizeCategoryResult);

                if($getCategoryResult){
                    $message = 'Фильтр по категории: ' . $getCategoryResult[0]['name'];
                }

                // отправка в модель блога (статьи,публикации)
                $getArticles = $this->container->get('model_get_articles_vip');
                $getArticlesResult = $getArticles -> getArticlesByCategory($sanitizeCategoryResult, $userStatus);
                $data = $getArticlesResult;

            } else {

                // отправка в модель категорий
                $getCategory = $this->container->get('model_get_category');
                $getCategoryList   =  $getCategory -> getCategoryList();

                // отправка в модель блога (статьи,публикации)
                $getArticles = $this->container->get('model_get_articles_vip');
                $getArticlesResult =  $getArticles -> getArticles($userStatus);
                $data = $getArticlesResult;
            }

            return $this->render('content/vip-page.html.twig', array(
                'user_authorized' => $userAuthorized,
                'category_id'   => $categoryId,
                'category_list' => $getCategoryList,
                'message'       => $message,
                'data'          => $data,
            ));


        // #### НЕ АВТОРИЗОВАН. ####
        } else {
            return $this->render('content/404-page.html.twig', array(
                'message' => 'Не авторизированый пользователь или недостаточно привилегий !',
            ));
        }

    } // .fn
}

