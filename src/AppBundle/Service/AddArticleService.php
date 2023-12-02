<?php
/**
 *  проверка данных AddArticle
 */

namespace AppBundle\Service;

class AddArticleService
{
    public function checkData_Insert() {
        $postData = array();

        if (
            isset($_SESSION['id'])       && !empty($_SESSION['id']) &&
            isset($_POST['title'])       && !empty($_POST['title']) &&
            isset($_POST['content'])     && !empty($_POST['content']) &&
            isset($_POST['date'])        && !empty($_POST['date']) &&
            isset($_POST['category_id']) && !empty($_POST['category_id']) &&
            isset($_POST['status'])      && !empty($_POST['status']) &&
            isset($_POST['access'])      && !empty($_POST['access'])
        ){
            $title        = trim(htmlspecialchars(htmlentities($_POST['title'], ENT_QUOTES )));
            $content      = trim(htmlspecialchars(htmlentities($_POST['content'], ENT_QUOTES )));
            $date         = $_POST['date'];
            $author_id    = $_SESSION['id'];
            $category_id  = $_POST['category_id'];
            $status       = $_POST['status'];
            $access       = $_POST['access'];

            $postData = array(
                'title'       => $title,
                'content'     => $content,
                'date'        => $date,
                'author_id'   => $author_id,
                'category_id' => $category_id,
                'status'      => $status,
                'access'      => $access,
            );

            return $postData;
        } else {
            return $postData;
        }

    }


}