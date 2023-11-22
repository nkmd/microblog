<?php
/**
 *  проверка данных LoginPage
 */
namespace AppBundle\Service;
class LoginService
{
    public function checkData($query) {
        $data = trim(htmlspecialchars(htmlentities($query, ENT_QUOTES )));
        return $data;
    }
}