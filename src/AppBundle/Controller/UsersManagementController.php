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


        // #### ВТОРИЗОВАН. ####
        if ( isset($sessionResult['session_user_login']) && !empty($sessionResult['session_user_login']) &&
             isset($sessionResult['session_user_role']) == 'admin'){
             $userAuthorized = $sessionResult;

            // запрос списка пользователей из модели (для табл.)
            $usersList = $this->container->get('model_get_users');
            $usersListResponse = $usersList->getUsersList();
            $listUsers = $usersListResponse;


            /* ===  POST добавление === */
            if(isset($_POST['add_btn'])){

                // Валидация введённых данных.
                $checkData = new UsersSrv();
                $checkDataResponse = $checkData-> checkPostData();

                // запрос в модель на обновление

                $message = 'Информация добавлена';
            }

            /* ===  POST Обновление === */
            if(isset($_POST['update_btn'])){
                // Валидация введённых данных.
                $checkData = new UsersSrv();
                $checkDataResponse = $checkData->checkPostData();

                if (!$checkDataResponse){
                    $message = 'Не все данные, были заполнены, или некоректные данные';

                } else {
                    //запрос в модель на обновление
                    $updateUser = $this->container->get('model_get_users');
                    $updateUserResult =  $updateUser -> updateUser($checkDataResponse);

                    if (!$updateUserResult){
                        $message = '__err: Информация не обновлена.';
                    } else {
                        $message = 'Информация обновлена.';
                        $data = $checkDataResponse;
                    }
                }
            }


            /* === POST Удаление === */
            if(isset($_POST['delete_btn'])){
                // запрос в модель на удаление
                $message = 'Пользователь Удалён';
            }


            return $this->render('content/users-management-page.html.twig', array(
                'message'    => $message,
                'list_users' => $listUsers,
                'data'       => $data,
            ));


            // #### НЕ авторизован. ####
        } else {
            return $this->render('content/404-page.html.twig', array(
                'message' => 'Не авторизированый пользователь или недостаточно привилегий !',
            ));
        }


    } /*fn*/
}
