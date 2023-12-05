<?php
/**
 *  контролер SearchPage
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\SearchService as SearchSrv;
use AppBundle\Service\SessionService as SessionSrv;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="search")
     */
    public function createSearchPage()
    {
        $userAuthorized = '';
        $userStatus = '';
        $message = '';
        $searchValue = '';
        $data  = '';

        // Инициализация СЕССИИ
        $session =  new SessionSrv();
        $sessionResult = $session->startSession();

        if ( isset($sessionResult['session_user_login']) && !empty($sessionResult['session_user_login']) &&
            isset($sessionResult['session_user_role'])) {
            $userAuthorized = $sessionResult;
            $userStatus = $sessionResult['session_user_role'];
        }

        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $searchValue = $_GET['q'];
            $message = 'Результат поиска по фразе: " ' . $searchValue . ' " ';

            // валидация введёных в поиск
            $sanitizeValue = new SearchSrv();
            $sanitizeValueResult = $sanitizeValue->checkData($searchValue);

            if (!$sanitizeValueResult) {
                $message = '... unknown error !$sanitizeValueResult ';
            } else {
                // Отправить в модель поиска (по заголовку)
                $getArticles = $this->container->get('model_get_search');
                $getArticlesResult = $getArticles->getData($sanitizeValueResult, $userStatus);

                $message .= ' Найдено публикаций: ' . count($getArticlesResult);
                $data = $getArticlesResult;
            }
        }

        return $this->render('content/search-page.html.twig', array(
            'user_authorized' => $userAuthorized,
            'message'         => $message,
            'search_value'    => $searchValue,
            'data'            => $data,
        ));


    }
}

