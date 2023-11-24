<?php
/**
 *   контроллер LoginPage
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Service\LoginService as LoginSrv;
use AppBundle\Service\SessionService as SessionSrv;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function createLoginPage()
    {

        $test =  new SessionSrv();
        $test2 = $test->setSession();

//        if (isset($_POST['exit_btn'])) {
//            $this->endSession();
//        }

        if ( isset($_POST['enter_btn']) &&
            isset($_POST['login']) && !empty($_POST['login']) &&
            isset($_POST['pass']) && !empty($_POST['pass']) ) {

            $message = '';
            $login = $_POST['login'];
            $pass  = $_POST['pass'];

            // проверка на валидность
            $checkData = new LoginSrv();
            $checkResponse = $checkData->checkData($login, $pass);

            // Запрос в модель | array('login','pass')
            $getData = $this->container->get('model_get_user');
            $dataUser = $getData->getData($checkResponse);

            if(count($dataUser) != 0){
                $message = 'ОК';
                $data = $this->startSession($dataUser);

            } else {
                $message = 'Нет такого пользователя или учётные двнные не верны';
                $data = '';
            }

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


    /* #############  Сесии ############# */
    public function startSession($dataUser) {
        //var_dump($dataUser);

        $test =  new SessionSrv();
        $test2 = $test->setStatusSession($dataUser[0]['name'], $dataUser[0]['role'], time());

//        var_dump($test2);
//        die();

    }

    public function endSession() {
//        $test =  new SessionSrv();
//        $test2 = $test->destroySession();
    }


}
