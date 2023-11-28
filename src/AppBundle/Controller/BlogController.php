<?php
/**
 *  контролер BlogPage
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Service\CategoryService as CategorySrv;
use AppBundle\Service\BlogService as BlogSrv;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="blog")
     */

    public function createBlogPage()
    {
        $getCategoryList ='';
        $category = '';
        $message = '';
        $data  = '';

        if(isset($_GET['filter']) && $_GET['filter'] != 0) {
            // валидация категории
            $category = $_GET['filter'];
            $sanitizeCategory = new CategorySrv();
            $sanitizeCategoryResult = $sanitizeCategory->checkData($category);

            // отправка в модель категорий
            $getCategory = $this->container->get('model_get_category');
            $getCategoryList   =  $getCategory -> getCategoryList();
            $getCategoryResult =  $getCategory -> getCategoryById($sanitizeCategoryResult);

            $message = 'Фильтр по категории: ' . $getCategoryResult[0]['name'];

            // отправка в модель блога (статьи,публикации)
            $getArticles = $this->container->get('model_get_articles');
            $getArticlesResult =  $getArticles -> getArticlesByCategory($sanitizeCategoryResult);
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
                $getArticlesResult =  $getArticles -> getArticles();
                $data = $getArticlesResult;
//                var_dump($data);die();
            }
        }

        return $this->render('content/blog-page.html.twig', array(
            'category_list' => $getCategoryList,
            'message'       => $message,
            'data'          => $data,
        ));
    }
}



/**
 * // Matches /blog exactly
 *
 * // @Route("/blog", name="blog_list")
 */


/**
 * // Matches /blog/*
 *
 * // @Route("/blog/{slug}", name="blog_show")
 */
