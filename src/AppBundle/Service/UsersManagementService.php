<?php
/**
 *  проверка данных UsersManagement Service
 */
namespace AppBundle\Service;
class UsersManagementService
{
    public function checkPostData() {
        $response = false;

        if (
            isset($_POST['usr_id'])    && !empty($_POST['usr_id']) &&
            isset($_POST['usr_name'])  && !empty($_POST['usr_name']) &&
            isset($_POST['usr_login']) && !empty($_POST['usr_login']) &&
            isset($_POST['usr_pass'])  && !empty($_POST['usr_pass']) &&
            isset($_POST['usr_role'])  && !empty($_POST['usr_role'])
        ){

//        $usr_id = trim(htmlspecialchars(htmlentities(, ENT_QUOTES )));
//        $usr_name  = trim(htmlspecialchars(htmlentities(, ENT_QUOTES )));
//        $usr_login = trim(htmlspecialchars(htmlentities($login, ENT_QUOTES )));
//        $usr_pass  = trim(htmlspecialchars(htmlentities($login, ENT_QUOTES )));
//        $usr_role  = trim(htmlspecialchars(htmlentities($login, ENT_QUOTES )));

            $response = true;
            return $response;


        } else {
            return $response;
        }
    }




}