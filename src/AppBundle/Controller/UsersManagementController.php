<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\SessionService as SessionSrv;
use AppBundle\Service\UsersManagementService as UsersSrv;

class UsersManagementController extends Controller
{
    /**
     * @Route("/usersmanagement", name="usersmanagement")
     */
    public function createAddArticlePage()
    {
        $message = '';
        $listUsers = '';
        $data = '';

        // Инициализация СЕССИИ
        $session = new SessionSrv();
        $sessionResult = $session->startSession();

        // АВТОРИЗОВАН.
        if ( isset($sessionResult['session_user_login']) && !empty($sessionResult['session_user_login']) &&
             isset($sessionResult['session_user_role']) == 'admin'){
             $userAuthorized = $sessionResult;

            // запрос списка пользователей из модели (для табл.)
            $usersList = $this->container->get('model_get_users');
            $usersListResponse = $usersList->getUsersList();
            $listUsers = $usersListResponse;


            // POST добавление
            if(isset($_POST['add_btn'])){

                // Валидация введённых данных.
                $checkData = new UsersSrv();
                $checkDataResponse = $checkData-> checkPostData();

                // запрос в модель на обновление

                $message = 'Информация добавлена';
            }

            // POST Обновление
            if(isset($_POST['update_btn'])){

                // Валидация введённых данных.
//                $checkData = new UsersSrv();
//                $checkDataResponse = $checkData->checkPostData();

                var_dump($_POST); die();

//                if (
//                    isset($_POST['usr_id'])    && !empty($_POST['usr_id']) &&
//                    isset($_POST['usr_name'])  && !empty($_POST['usr_name']) &&
//                    isset($_POST['usr_login']) && !empty($_POST['usr_login']) &&
//                    isset($_POST['usr_pass'])  && !empty($_POST['usr_pass']) &&
//                    isset($_POST['usr_role'])  && !empty($_POST['usr_role'])
//                ){
//                    $data = true;
//                }

                // запрос в модель на обновление

//                $message = 'Информация обновлена';
//                $data = $checkDataResponse;
            }

            // POST Удаление
            if(isset($_POST['delete_btn'])){
                // запрос в модель на удаление
                $message = 'Пользователь Удалён';
            }


            return $this->render('content/users-management-page.html.twig', array(
                'message'    => $message,
                'list_users' => $listUsers,
                'data'       => $data,
            ));


            // НЕ авторизован.
        } else {
            return $this->render('content/404-page.html.twig', array(
                'message' => 'Не авторизированый пользователь или недостаточно привилегий !',
            ));
        }


    } /*fn*/
}
