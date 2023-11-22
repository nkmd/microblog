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
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $message = 'Результат поиска: ';
            $query = $_GET['q'];

            $checkData = new SearchSrv();
            $checkResponse = $checkData->checkData($query);

            // Отправить в модель
            $getData = $this->container->get('model_get_search');
            $data = $getData->getData($checkResponse);

        } else {
            $message = 'В ведите искомое значение';
            $checkResponse = '';
            $data  = '';
        }

        return $this->render('content/search-page.html.twig', array(
            'message' => $message,
            'checkResponse' =>  $checkResponse,
            'data'    => $data,
        ));
    }


}

