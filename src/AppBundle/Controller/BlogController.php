<?php
/**
 *  контролер BlogPage
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\SessionService as SessionSrv;
use AppBundle\Service\CategoryService as CategorySrv;
use AppBundle\Service\BlogService as BlogSrv;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="blog")
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

        if ( isset($sessionResult['session_user_login']) && !empty($sessionResult['session_user_login']) &&
            isset($sessionResult['session_user_role'])) {
            $userAuthorized = $sessionResult;
            $userStatus = $sessionResult['session_user_role'];
        }

        if(isset($_GET['filter']) && $_GET['filter'] != 0) {
            // валидация категории
            $categoryId = $_GET['filter'];
            $sanitizeCategory = new CategorySrv();
            $sanitizeCategoryResult = $sanitizeCategory->checkData($categoryId);

            // отправка в модель категорий
            $getCategory = $this->container->get('model_get_category');
            $getCategoryList   =  $getCategory -> getCategoryList();
            $getCategoryResult =  $getCategory -> getCategoryById($sanitizeCategoryResult);

            if($getCategoryResult){
                $message = 'Фильтр по категории: ' . $getCategoryResult[0]['name'];
            }

            // отправка в модель блога (статьи,публикации)
            $getArticles = $this->container->get('model_get_articles');
            $getArticlesResult =  $getArticles -> getArticlesByCategory($sanitizeCategoryResult, $userStatus);
            $data = $getArticlesResult;

        } else {
            // валидация блога(не тр. на буд.)
            $sanitizeBlog = new BlogSrv();
            $sanitizeBlogResult = $sanitizeBlog->checkData();
            if (!$sanitizeBlogResult) {
                $message = '... unknown error !$sanitizeBlogResult ';

            } else {
                // отправка в модель категорий
                $getCategory = $this->container->get('model_get_category');
                $getCategoryList   =  $getCategory -> getCategoryList();

                // отправка в модель блога (статьи,публикации)
                $getArticles = $this->container->get('model_get_articles');
                $getArticlesResult =  $getArticles -> getArticles($userStatus);
                $data = $getArticlesResult;
            }
        }

        return $this->render('content/blog-page.html.twig', array(
            'user_authorized' => $userAuthorized,
            'category_id'   => $categoryId,
            'category_list' => $getCategoryList,
            'message'       => $message,
            'data'          => $data,
        ));
    }
}
