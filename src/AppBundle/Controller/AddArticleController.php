<?php
/**
 *  контролер AddArticle
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\SessionService as SessionSrv;
use AppBundle\Model\CategoryModel as CategoryMdl;
use AppBundle\Service\AddArticleService as AddArticleSrv;

class AddArticleController extends Controller
{
    /**
     * @Route("/addarticle", name="addarticle")
     */

    public function createAddArticlePage()
    {
        $userAuthorized = '';
        $message = '';
        $data  = array();

        // Инициализация СЕССИИ
        $session =  new SessionSrv();
        $sessionResult = $session->startSession();

        if ( isset($sessionResult['session_user_login']) && !empty($sessionResult['session_user_login']) ) {
            $userAuthorized = $sessionResult;
        }


        // авторизован.
        if ($userAuthorized) {
            $message = 'No Post';
            // запрос списка категорий

            $category = $this->container->get('model_get_category');
            $categoryList = $category->getCategoryList();
            $data['category_list'] = $categoryList;

            // авторизован и есть данные POST.
            if (isset($_POST['add_article_btn'])) {
                $message = 'Post EST';

                // праверка на валидность
                $checkData = new AddArticleSrv();
                $checkResponse = $checkData->checkData();
                if (!$checkResponse) {
                    $message = 'Что-то незаполнено';
                    var_dump($checkResponse);
                    //die();

                } else {

                    // отправка в модель
                    $articleModel = $this->container->get('model_add_article');
                    $addArticle = $articleModel->addArticle($checkResponse);

                    var_dump($addArticle);
                    //$data['content_article'] = $checkResponse;
                }
            }




            $data['content'] = 'content text';

            return $this->render('content/add-article-page.html.twig', array(
                'user_authorized' => $userAuthorized,
                'message' => $message, //$message,
                'data' => $data,
            ));


        // НЕ авторизован.
        } else {
            return $this->render('content/404-page.html.twig', array(
                'message' => 'Не авторизированый пользователь или недостаточно привилегий !',
                'data' => $data,
            ));
        }

    }
}
