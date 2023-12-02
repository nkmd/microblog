<?php
/**
 *  контролер EditArticlePage
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\SessionService as SessionSrv;
use AppBundle\Service\ArticleService as ArticleSrv;

class EditArticleController extends Controller
{
    /**
     * @Route("/editarticle", name="editarticle_list")
     */
    public function redirectToBlogList()
    {
        header("Location: /404");
        exit;
    }

    /**
     * @Route("/editarticle/{id}", name="editarticle", methods={"GET"})
     */

    public function editArticlePage($id)
    {
        $articleId = $id;
        $userAuthorized = '';
        $listCategories = '';
        $message = '';
        $data = '';

        // Инициализация СЕССИИ
        $session = new SessionSrv();
        $sessionResult = $session->startSession();

        // #### ВТОРИЗОВАН. ####
        if (isset($sessionResult['session_user_login']) && !empty($sessionResult['session_user_login']) &&
            isset($sessionResult['session_user_role']) && $sessionResult['session_user_role'] == 'admin') {
            $userAuthorized = $sessionResult;



            /* ===  POST добавление === */
            if (isset($_POST['add_btn'])) {
                // Валидация введённых данных.
                $checkData = new AddArticleSrv();
                $checkDataResponse = $checkData->checkData_Insert();

                if (!$checkDataResponse) {
                    $message = 'Не все данные, были заполнены, или некоректные данные';

                } else {
                    // запрос в модель на добавление
                    $addArticle = $this->container->get('model_add_article');
                    $addArticleResult = $addArticle->insertArticle($checkDataResponse);

                    if (!$addArticleResult) {
                        $message = '__err: немогу добавить статью';
                    } else {
                        $data = $addArticleResult;
                        $message = 'Информация добавлена.';
                    }

                }
            }

            /* === запрос списка контента из модели === */
            $getArticleContent = $this->container->get('model_edit_article');
            $getArticleResponse = $getArticleContent ->getArticleData($articleId);
            $data = $getArticleResponse;

            /* === запрос списка категорий из модели === */
            $categoriesList = $this->container->get('model_get_categories');
            $categoriesListResponse = $categoriesList->getCategoriesList();
            $listCategories = $categoriesListResponse;

            return $this->render('content/edit-article-page.html.twig', array(
                'user_authorized' => $userAuthorized,
                'message' => $message,
                'categories_list' => $listCategories,
                'data' => $data,
            ));


            // #### НЕ АВТОРИЗОВАН. ####
        } else {
            return $this->render('content/404-page.html.twig', array(
                'message' => 'Не авторизированый пользователь или недостаточно привилегий !',
            ));
        }


    }
}
