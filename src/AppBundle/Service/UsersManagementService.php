<?php
/**
 *  проверка данных UsersManagement Service
 */
namespace AppBundle\Service;
class UsersManagementService
{

    public function checkPostData_Insert() {
        $response = false;

        if (
            isset($_POST['usr_name'])  && !empty($_POST['usr_name']) &&
            isset($_POST['usr_login']) && !empty($_POST['usr_login']) &&
            isset($_POST['usr_pass'])  && !empty($_POST['usr_pass']) &&
            isset($_POST['usr_role'])  && !empty($_POST['usr_role'])
        ){
            $usr_name    = trim(htmlspecialchars(htmlentities($_POST['usr_name'], ENT_QUOTES )));
            $usr_login_r = str_replace(" ", '', $_POST['usr_login']);
            $usr_login   = trim(htmlspecialchars(htmlentities($usr_login_r, ENT_QUOTES )));
            $usr_pass    = trim(htmlspecialchars(htmlentities($_POST['usr_pass'], ENT_QUOTES )));
            $usr_role    = trim(htmlspecialchars(htmlentities($_POST['usr_role'], ENT_QUOTES )));

            $response = array(
                'usr_name'  => $usr_name,
                'usr_login' => $usr_login,
                'usr_pass'  => $usr_pass,
                'usr_role'  => $usr_role,
            );
            return $response;

        } else {
            return $response;
        }
    }


    public function checkPostData_Delete() {
        $response = false;
        if( isset($_POST['usr_id']) && !empty($_POST['usr_id'])){
            $usr_id = (int) abs($_POST['usr_id']);
            $response = $usr_id;
            return $response;
        } else {
            return $response;
        }
    }


    public function checkPostData_Update() {
        $response = false;

        if (
            isset($_POST['usr_id'])    && !empty($_POST['usr_id']) &&
            isset($_POST['usr_name'])  && !empty($_POST['usr_name']) &&
            isset($_POST['usr_login']) && !empty($_POST['usr_login']) &&
            isset($_POST['usr_pass'])  && !empty($_POST['usr_pass']) &&
            isset($_POST['usr_role'])  && !empty($_POST['usr_role'])
        ){
            $usr_id = (int) abs($_POST['usr_id']);
            $usr_name  = trim(htmlspecialchars(htmlentities($_POST['usr_name'], ENT_QUOTES )));
            $usr_login_r = str_replace(" ", '', $_POST['usr_login']);
            $usr_login = trim(htmlspecialchars(htmlentities($usr_login_r, ENT_QUOTES )));
            $usr_pass  = trim(htmlspecialchars(htmlentities($_POST['usr_pass'], ENT_QUOTES )));
            $usr_role  = trim(htmlspecialchars(htmlentities($_POST['usr_role'], ENT_QUOTES )));

            $response = array(
                'usr_id'    => $usr_id,
                'usr_name'  => $usr_name,
                'usr_login' => $usr_login,
                'usr_pass'  => $usr_pass,
                'usr_role'  => $usr_role,
            );
            return $response;


        } else {
            return $response;
        }
    }




}