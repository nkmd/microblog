<?php
/**
 *  контролер EditArticlePage
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\SessionService as SessionSrv;
use AppBundle\Service\EditArticleService as EditArticleSrv;

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
     * @Route("/editarticle/{id}", name="editarticle")
     * //, methods={"GET"}
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

            /* ===  POST Редактирование === */
            if (isset($_POST['edit_btn'])) {
                // Валидация введённых данных.
                $checkData = new EditArticleSrv();
                $checkDataResponse = $checkData->checkData_Update($articleId);

                if (!$checkDataResponse) {
                    $message = 'Не все данные, были заполнены, или некоректные данные';
                } else {

                    // запрос в модель на изменение
                    $editArticle = $this->container->get('model_edit_article');
                    $editArticleResult = $editArticle->editArticle($checkDataResponse);

                    if (!$editArticleResult) {
                        $message = '__err: немогу обновить статью';
                    } else {
                        $data = $editArticleResult;
                        $message = 'Информация обновлена.';
                    }
                }
            }

            /* ===  POST Удаление === */
            if (isset($_POST['del_btn'])) {
                $deleteArticle = $this->container->get('model_edit_article');
                $deleteArticleResult = $deleteArticle->deleteArticle($articleId);

                if (!$deleteArticleResult) {
                    $message = '__err: немогу удалить статью';
                } else {
                    return $this->render('content/404-page.html.twig', array(
                        'user_authorized' => $userAuthorized,
                        'message' => 'Статья Удалена из БД.',
                    ));
                }
            }


            /* === запрос контента статьи из модели === */
            $getArticleContent = $this->container->get('model_edit_article');
            $getArticleResponse = $getArticleContent->getArticleContent($articleId);
            $data = $getArticleResponse;

            /* === запрос списка категорий из модели === */
            $categoriesList = $this->container->get('model_get_categories');
            $categoriesListResponse = $categoriesList->getCategoriesList();
            $listCategories = $categoriesListResponse;

            /* === запрос списка авторов статьи из модели === */
            $getAuthorsList = $this->container->get('model_get_users');
            $getAuthorsListResponse = $getAuthorsList->getUserByRole('admin');
            $listAuthors = $getAuthorsListResponse;

            return $this->render('content/edit-article-page.html.twig', array(
                'user_authorized' => $userAuthorized,
                'message'         => $message,
                'categories_list' => $listCategories,
                'authors_list'    => $listAuthors,
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
