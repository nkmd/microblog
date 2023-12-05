<?php
/**
 *  Сесии пользователя
 */
namespace AppBundle\Service;

class SessionService
{
    public function startSession(){
        session_name('nk_session');// имя сесии
        ini_set('session.gc_maxlifetime',3600);// жизнь сесии 'sec'
        ini_set('session.save_path', $_SERVER['DOCUMENT_ROOT'] .'/_session_dir/');// директория сесии временно.
        session_start();

        $sessionData = array();
        if(isset($_SESSION['login']) && !empty($_SESSION['login'])) {

            $sessionData = array(
                'session_user_id'    => $_SESSION['id'],
                'session_user_name'  => $_SESSION['name'],
                'session_user_login' => $_SESSION['login'],
                'session_user_role'  => $_SESSION['role'],
                'session_time'       => $_SESSION['time'],
            );
        }

        return $sessionData;
    }


//        if(isset($_SESSION['time']) && (time()-$_SESSION['time']) > 60) {
//            session_destroy();
//            echo '<h2 style="color:red;"> время сессии истекло </h2><br>';
//        }

    public function setUserSession($userData){
        $_SESSION['id']    = $userData[0]['id'];
        $_SESSION['name']  = $userData[0]['name'];
        $_SESSION['login'] = $userData[0]['login'];
        $_SESSION['role']  = $userData[0]['role'];
        $_SESSION['time']  = time();

        session_write_close();
        return true;
    }

    public function destroyUserSession(){
        //session_unset();
        session_destroy();
        return true;
    }

}