<?php
/**
 *   контроллер LoginPage
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Service\LoginService as LoginSrv;

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

            // проверка на валидность
            $checkData = new LoginSrv();
            $checkResponse = $checkData->checkData($login, $pass);

            // Запрос в модель | array('login','pass')
            $getData = $this->container->get('model_get_user');
            $data = $getData->getData($checkResponse);

            var_dump($data);

            // РЕШЕНИЕ


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
