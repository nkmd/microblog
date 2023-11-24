<?php

namespace AppBundle\Service;

class SessionService
{

    public function setSession(){
        session_name('nk_session');// имя сесии
        ini_set('session.gc_maxlifetime',120);// жизнь сесии 'sec'
        ini_set('session.save_path', $_SERVER['DOCUMENT_ROOT'] .'/session_dir/');// директория сесии
        session_start();

        if (isset($_POST['exit_btn'])) {
            //$this->destroySession();
            session_destroy();
            echo 'destroy';
        }

        if(isset($_SESSION['name']) && !empty($_SESSION['name'])){
            echo '<h4> SESSION name : '.$_SESSION['name']. $_SESSION['role']. $_SESSION['time'].'</h4><br>';
            //print_r($_SESSION);
        }

//        if(isset($_SESSION['time']) && (time()-$_SESSION['time']) > 60) {
//            session_destroy();
//            echo '<h2 style="color:red;"> время сессии истекло </h2><br>';
//        }

        return null;
    }

    public function setStatusSession($name, $role, $time){
        $_SESSION['name'] = $name;
        $_SESSION['role'] = $role;
        $_SESSION['time'] = $time;
        session_write_close();
        return null;
    }

    public function destroySession(){
        //session_unset();
        session_destroy();
        return null;
    }
//    function getStatus(){
//
//    }
}