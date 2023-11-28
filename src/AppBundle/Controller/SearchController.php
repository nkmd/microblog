<?php
/**
 *  контролер SearchPage
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\SearchService as SearchSrv;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="search")
     */
    public function createSearchPage()
    {
        $message = '';
        $searchValue = '';
        $data  = '';

        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $searchValue = $_GET['q'];
            $message = 'Результат поиска: ' . $searchValue;

            // валидация введёных в поиск
            $sanitizeValue = new SearchSrv();
            $sanitizeValueResult = $sanitizeValue->checkData($searchValue);

            if (!$sanitizeValueResult) {
                $message = '... unknown error !$sanitizeValueResult ';
            } else {
                // Отправить в модель поиска (по заголовку)
                $getArticles = $this->container->get('model_get_search');
                $getArticlesResult = $getArticles->getData($sanitizeValueResult);
                $data = $getArticlesResult;
            }

        }

        return $this->render('content/search-page.html.twig', array(
            'message'      => $message,
            'search_value' =>  $searchValue,
            'data'         => $data,
        ));
    }


}

