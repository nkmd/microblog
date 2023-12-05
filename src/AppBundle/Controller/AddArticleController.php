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
        $listCategories ='';
        $message = '';
        $data = '';

        // Инициализация СЕССИИ
        $session = new SessionSrv();
        $sessionResult = $session->startSession();

        // #### ВТОРИЗОВАН. ####
        if ( isset($sessionResult['session_user_login']) && !empty($sessionResult['session_user_login']) &&
            isset($sessionResult['session_user_role']) && $sessionResult['session_user_role'] == 'admin'){
            $userAuthorized = $sessionResult;

            /* === запрос списка категорий из модели === */
            $categoriesList = $this->container->get('model_get_categories');
            $categoriesListResponse = $categoriesList->getCategoriesList();
            $listCategories = $categoriesListResponse;

            /* ===  POST добавление === */
            if(isset($_POST['add_btn'])){
                // Валидация введённых данных.
                $checkData = new AddArticleSrv();
                $checkDataResponse = $checkData->checkData_Insert();

                if (!$checkDataResponse) {
                    $message = 'Не все данные, были заполнены, или некоректные данные';

                } else {
                    // запрос в модель на добавление
                    $addArticle = $this->container->get('model_add_article');
                    $addArticleResult = $addArticle->insertArticle($checkDataResponse);

                    if(!$addArticleResult){
                        $message = '__err: немогу добавить статью';
                    } else {
                        $data = $addArticleResult;
                        $message = 'Информация добавлена.';
                    }
                }
            }

            return $this->render('content/add-article-page.html.twig', array(
                'user_authorized' => $userAuthorized,
                'message'         => $message,
                'categories_list' => $listCategories,
                'data'            => $data,
            ));


            // #### НЕ АВТОРИЗОВАН. ####
        } else {
            return $this->render('content/404-page.html.twig', array(
                'message' => 'Не авторизированый пользователь или недостаточно привилегий !',
            ));
        }



    }
}