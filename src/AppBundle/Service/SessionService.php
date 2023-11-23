<?php

namespace AppBundle\Service;

class SessionService
{

    public function setSession(){
        session_name('nk_session');// имя сесии
        //echo session_name();
        ini_set('session.gc_maxlifetime',1);// жизнь сесии
        ini_set('session.save_path', $_SERVER['DOCUMENT_ROOT'] .'/session_dir/');// директория сесии
        //echo $_SERVER['DOCUMENT_ROOT'].'<br>';
        //echo getcwd() . "\n";
        session_start();

        if(isset($_SESSION['name']) && !empty($_SESSION['name'])){
            echo '<h4> SESSION name : '.$_SESSION['name']. $_SESSION['role']. $_SESSION['time'].'</h4><br>';
        }

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
        session_unset();
        //session_destroy();
        return null;
    }
//    function getStatus(){
//
//    }
}