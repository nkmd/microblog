<?php
/**
 *  проверка данных LoginPage
 */
namespace AppBundle\Service;
class LoginService
{
    public function checkData($login, $pass) {
        $loginData = trim(htmlspecialchars(htmlentities($login, ENT_QUOTES )));
        $passData = trim(htmlspecialchars(htmlentities($pass, ENT_QUOTES )));
        $data = array(
            'login' => $loginData,
            'pass'  => $passData
        );
        return $data;
    }
}