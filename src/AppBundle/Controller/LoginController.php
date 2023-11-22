<?php
/**
 *   контроллер LoginPage
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function createLoginPage()
    {
        if (isset($_POST['login']) && !empty($_POST['login']) &&
            isset($_POST['pass']) && !empty($_POST['pass'])) {

            $message = '';
            $login = $_POST['login'];
            $pass  = $_POST['pass'];

            $data = $login .' '. $pass;




//            $checkData = new SearchSrv();
//            $checkResponse = $checkData->checkData($query);
//
//            // Отправить в модель
//            $getData = $this->container->get('model_get_search');
//            $data = $getData->getData($checkResponse);

        } else {
            $message = 'Заполните все поля';
            $checkResponse = '';
            $data  = '';
        }

        return $this->render('content/login-page.html.twig', array(
            'message' => $message,
            //'checkResponse' =>  $checkResponse,
            'data'    => $data,
        ));
    }
}
