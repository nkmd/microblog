<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\SessionService as SessionSrv;
use AppBundle\Service\CategoriesManagementService as CategoriesSrv;

class CategoriesManagementController extends Controller
{
    /**
     * @Route("/categoriesmanagement", name="categoriesmanagement")
     */
    public function createUserPage()
    {
        $userAuthorized = '';
        $message = '';
        $listCategories = '';
        $data = '';

        // Инициализация СЕССИИ
        $session = new SessionSrv();
        $sessionResult = $session->startSession();


        // #### ВТОРИЗОВАН. ####
        if ( isset($sessionResult['session_user_login']) && !empty($sessionResult['session_user_login']) &&
             isset($sessionResult['session_user_role']) && $sessionResult['session_user_role'] == 'admin'){
             $userAuthorized = $sessionResult;

            //var_dump($sessionResult['session_user_role']); die();

            /* ===  POST добавление === */
            if(isset($_POST['add_btn'])){
                // Валидация введённых данных.
                $checkData = new CategoriesSrv();
                $checkDataResponse = $checkData->checkPostData_Insert();

                if (!$checkDataResponse) {
                    $message = 'Не все данные, были заполнены, или некоректные данные';

                } else {
                    // запрос в модель на добавление
                    $addCategory = $this->container->get('model_get_categories');
                    $addCategoryResult = $addCategory->insertCategory($checkDataResponse);

                    if(!$addCategoryResult){
                        $message = 'Данный логин уже существует. Ввведите другй логин.';
                    } else {
                        $data = $addCategoryResult;
                        $message = 'Информация добавлена.';
                    }

                }
            }


            /* ===  POST Обновление === */
            if(isset($_POST['update_btn'])){

                // Валидация введённых данных.
                $checkData = new UsersSrv();
                $checkDataResponse = $checkData->checkPostData_Update();

                if (!$checkDataResponse){
                    $message = 'Не все данные, были заполнены, или некоректные данные';

                } elseif ($checkDataResponse['usr_id'] == 1 && $checkDataResponse['usr_role'] !== 'admin') {
                    $message = 'Мастер-Админ НЕ Может понизить роль!';

                } else {
                    //запрос в модель на обновление
                    $updateUser = $this->container->get('model_get_users');
                    $updateUserResult = $updateUser->updateUser($checkDataResponse);

                    if (!$updateUserResult){
                        $message = 'Данный ЛОГИН занят. Информация не обновлена.';
                    } else {
                        $message = 'Информация обновлена.';
                        $data = $checkDataResponse;
                    }
                }
            }


            /* === POST Удаление === */
            if(isset($_POST['delete_btn'])){
                // Валидация переданных данных (id).
                $checkData = new UsersSrv();
                $checkDataResponse = $checkData->checkPostData_Delete();

                if (!$checkDataResponse) {
                    $message = '__err: Не могу получить целое. Или перобразован 0';
                } elseif ($checkDataResponse == 1) {
                    $message = 'Мастер-Админ НЕ может быть удалён!';
                } else {
                    // запрос в модель на удаление
                    $deleteUser = $this->container->get('model_get_users');
                    $deleteUserResult = $deleteUser -> deleteUser($checkDataResponse);
                    if (!$deleteUserResult){
                        $message = 'Не могу удалить, не существует такой пользователь';
                    } else {
                        $message = 'Пользователь Удалён';
                    }
                }

            }


            /* === запрос списка категорий из модели (для табл. !Обязательно в конце!) === */
            $categoriesList = $this->container->get('model_get_categories');
            $categoriesListResponse = $categoriesList->getCategoriesList();
            $listCategories = $categoriesListResponse;

            return $this->render('content/categories-management-page.html.twig', array(
                'user_authorized' => $userAuthorized,
                'message'         => $message,
                'list_categories' => $listCategories,
                'data'            => $data,
            ));


            // #### НЕ АВТОРИЗОВАН. ####
        } else {
            return $this->render('content/404-page.html.twig', array(
                'message' => 'Не авторизированый пользователь или недостаточно привилегий !',
            ));
        }


    } /*fn*/
}
