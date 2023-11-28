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
        $userAuthorized = '';

        // Инициализация СЕССИИ
        $session =  new SessionSrv();
        $sessionResult = $session->startSession();

        if ( isset($sessionResult['session_user_login']) && !empty($sessionResult['session_user_login']) ) {
            $userAuthorized = $sessionResult;
            $message = 'Приветствуем: ' . $userAuthorized['session_user_name'] . '; ';
            $message .= 'Ваш логин: ' . $userAuthorized['session_user_login'] . '; ';
            $message .= 'Ваш статус: ' . $userAuthorized['session_user_role'] . '; ';

        // debug:
            var_dump($userAuthorized);
        } else {
            var_dump($userAuthorized);
        }

        // ВЫХОД  из кабинета
        if ( isset($_POST['exit_btn']) ) {
            $endSession = $session->destroyUserSession();
            if($endSession){
                $userAuthorized = '';
            }
        }

        // ВХОД в Кабинет
        if ( isset($_POST['enter_btn']) &&
            isset($_POST['login']) && !empty($_POST['login']) &&
            isset($_POST['pass']) && !empty($_POST['pass']) ) {

                $login = $_POST['login'];
                $pass  = $_POST['pass'];

                // валидация введённых данных (return: array())
                $sanitizeValue = new LoginSrv();
                $sanitizeValueResponse = $sanitizeValue->checkData($login, $pass);

                // Запрос в модель | array('login','pass')
                $getUser = $this->container->get('model_get_user');
                $getUserResponse = $getUser->getData($sanitizeValueResponse);

                // авторизирован - запись в СЕСИЮ
                if(count($getUserResponse) != 0){
                    $setUserSession = $session->setUserSession($getUserResponse);
                    if ($setUserSession){
                        $userAuthorized = $setUserSession;
                        $message = 'Добро пожаловать: ' . $userAuthorized['session_user_login'];
                    }

                } else {
                    $message = 'Нет такого пользователя или учётные двнные не верны';
                }
        }

        return $this->render('content/login-page.html.twig', array(
            'message'         => $message,
            'user_authorized' => $userAuthorized,
        ));
    }

}
