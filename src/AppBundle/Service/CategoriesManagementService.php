<?php
/**
 *  проверка данных CategoriesManagement Service
 */
namespace AppBundle\Service;
class CategoriesManagementService
{

    public function checkPostData_Insert() {
        $response = false;

        if (
            isset($_POST['cat_name']) && !empty($_POST['cat_name']) &&
            isset($_POST['cat_slug']) && !empty($_POST['cat_slug'])

        ){
            $cat_name    = trim(htmlspecialchars(htmlentities($_POST['cat_name'], ENT_QUOTES )));
            $cat_slug_r  = str_replace(" ", '', $_POST['cat_slug']);
            $cat_slug    = trim(htmlspecialchars(htmlentities($cat_slug_r, ENT_QUOTES )));

            $response = array(
                'cat_name' => $cat_name,
                'cat_slug' => $cat_slug,
            );
            return $response;

        } else {
            return $response;
        }
    }


    public function checkPostData_Delete() {
        $response = false;
        if( isset($_POST['cat_id']) && !empty($_POST['cat_id'])){
            $cat_id = (int) abs($_POST['cat_id']);
            $response = $cat_id;
            return $response;
        } else {
            return $response;
        }
    }


    public function checkPostData_Update() {
        $response = false;

        if (
            isset($_POST['cat_id'])   && !empty($_POST['cat_id']) &&
            isset($_POST['cat_name']) && !empty($_POST['cat_name']) &&
            isset($_POST['cat_slug']) && !empty($_POST['cat_slug']) &&
            isset($_POST['cat_slug_current']) && !empty($_POST['cat_slug_current'])

        ){
            $cat_id = (int) abs($_POST['cat_id']);
            $cat_name = trim(htmlspecialchars(htmlentities($_POST['cat_name'], ENT_QUOTES )));
            $cat_slug_r = str_replace(" ", '', $_POST['cat_slug']);
            $cat_slug = trim(htmlspecialchars(htmlentities($cat_slug_r, ENT_QUOTES )));
            $cat_slug_current_r = str_replace(" ", '', $_POST['cat_slug_current']);
            $cat_slug_current = trim(htmlspecialchars(htmlentities($cat_slug_current_r, ENT_QUOTES )));


            $response = array(
                'cat_id'           => $cat_id,
                'cat_name'         => $cat_name,
                'cat_slug'         => $cat_slug,
                'cat_slug_current' => $cat_slug_current,

            );
            return $response;


        } else {
            return $response;
        }
    }




}