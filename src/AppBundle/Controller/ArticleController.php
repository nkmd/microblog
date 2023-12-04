<?php
/**
 *  контролер ArticlePage
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\SessionService as SessionSrv;
use AppBundle\Service\ArticleService as ArticleSrv;

class ArticleController extends Controller
{
    /**
     * @Route("/article", name="blog_list")
     */
    public function redirectToBlogList(){
        header("Location: /blog");
        exit;
    }

    /**
     * @Route("/article/{id}", name="article", methods={"GET"})
     */
    /*  // requirements={"id"="\d+"} */

    public function createArticlePage($id)
    {
        $articleId = $id;
        $userAuthorized = '';
        $userStatus = '';
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

        // Статья по ID
        if(isset($articleId)) {
            // валидация ID стати
            $sanitizeArticle = new ArticleSrv();
            $sanitizeArticleResult = $sanitizeArticle->checkData($articleId);

            // отправка в модель блога (статьи,публикации)
            $getArticle = $this->container->get('model_get_article');
            $getArticleResult =  $getArticle -> getArticle($sanitizeArticleResult, $userStatus);

            if ( $getArticleResult ) {
                $data = $getArticleResult;
            } else {
                $message = 'Публикация не найдена';
            }

        } else {
            $message = 'Публикация не существует';
        }


        $hotMessage = $this->withMeaningMessage('hot');
        $imgMessage = $this->withMeaningMessage('img');


        return $this->render('content/article-page.html.twig', array(
            'user_authorized' => $userAuthorized,
            'message'         => $message,
            'data'            => $data,
            'hotMessage'     => $hotMessage,
            'imgMessage'    => $imgMessage,
        ));
    }

    public function withMeaningMessage($val) {
        $happyMessageGenerator = $this->container->get('app.message_generator');
        // shorter syntax
        // $happyMessageGenerator = $this->get('app.message_generator');
        if ($val === 'hot') {
            $happyMessageGenerator = $happyMessageGenerator->getHotMessage();
        } else {
            $happyMessageGenerator = $happyMessageGenerator->getDemotivatorMessage();
        }
        return ($happyMessageGenerator);
    }

}
