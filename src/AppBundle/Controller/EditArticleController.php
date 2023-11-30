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
    public function redirectToBlogList(){
        header("Location: /404");
        exit;
    }

    /**
     * @Route("/editarticle/{id}", name="editarticle", methods={"GET"})
     */

    public function createEditPage($id)
    {
        $articleId = $id;
        $userAuthorized = '';
        $message = '';
        $data  = '';

        // Инициализация СЕССИИ
        $session =  new SessionSrv();
        $sessionResult = $session->startSession();

        if ( isset($sessionResult['session_user_login']) && !empty($sessionResult['session_user_login']) ) {
            $userAuthorized = $sessionResult;
        }

        // Статья по ID
        if(isset($articleId)) {
            // валидация ID стати
            $sanitizeArticle = new ArticleSrv();
            $sanitizeArticleResult = $sanitizeArticle->checkData($articleId);

            // отправка в модель блога (статьи,публикации)
            $getArticle = $this->container->get('model_get_article');
            $getArticleResult =  $getArticle -> getArticle($sanitizeArticleResult);

            if ( $getArticleResult ) {
                $data = $getArticleResult;
            } else {
                $message = 'Публикация не найдена';
            }

        } else {
            $message = 'Публикация не существует';
        }

        return $this->render('content/article-page.html.twig', array(
            'user_authorized' => $userAuthorized,
            'message'         => $message,
            'data'            => $data,
        ));
    }



}
