<?php
/**
 *  контролер LoginPage
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Service\SessionService as SessionSrv;
use AppBundle\Service\LoginService as LoginSrv;


class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function createLoginPage()
    {
        $message = '';
        $data  = '';
        $userLogin = false;

        // сессия
        $session =  new SessionSrv();
        $sessionResult = $session->startSession();

        if ( isset($sessionResult['session_user_login']) && !empty($sessionResult['session_user_login']) ) {
            $userLogin = true;
            var_dump($sessionResult);
        } else {
            var_dump($sessionResult);
        }

        if ( isset($_POST['exit_btn']) ) {
            $endSession = $session->destroyUserSession();
            if($endSession){
                $userLogin = false;
            }
        }

        if ( isset($_POST['enter_btn']) &&
            isset($_POST['login']) && !empty($_POST['login']) &&
            isset($_POST['pass']) && !empty($_POST['pass']) ) {

                $login = $_POST['login'];
                $pass  = $_POST['pass'];

                // валидация введённых данных
                $checkData = new LoginSrv();
                $checkDataResponse = $checkData->checkData($login, $pass);

                // Запрос в модель | array('login','pass')
                $getData = $this->container->get('model_get_user');
                $userData = $getData->getData($checkDataResponse);

                // авторизирован - запись в сесию
                if(count($userData) != 0){
                    $message = 'ОК (userData)';
                    $setUserSession = $session->setUserSession($userData);
                    if ($setUserSession){
                        $message = 'ОК (setUserSession)';
                        $userLogin = true;
                    }

                } else {
                    $message = 'Нет такого пользователя или учётные двнные не верны';
                }
        }

        return $this->render('content/login-page.html.twig', array(
            'message'   => $message,
            'data'      => $data,
            'userLogin' => $userLogin,
        ));
    }

}
