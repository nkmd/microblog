<?php
/**
 *  проверка данных EditArticle
 */

namespace AppBundle\Service;

class EditArticleService
{
    public function checkData_Update($articleId) {

        if (
            isset($_POST['id'])          && !empty($_POST['id']) &&
            isset($_POST['title'])       && !empty($_POST['title']) &&
            isset($_POST['content'])     && !empty($_POST['content']) &&
            isset($_POST['author_id'])   && !empty($_POST['author_id']) &&
            isset($_POST['category_id']) && !empty($_POST['category_id']) &&
            isset($_POST['status'])      && !empty($_POST['status']) &&
            isset($_POST['access'])      && !empty($_POST['access'])
        ){

            $id           = $_POST['id'];
            $title        = trim(htmlspecialchars(htmlentities($_POST['title'], ENT_QUOTES )));
            //$content      = trim(htmlspecialchars(htmlentities($_POST['content'], ENT_QUOTES )));
            $content      = $_POST['content']; // WYSIWYG HTML editor
            $date         = $_POST['date'];
            $author_id    = $_POST['author_id'];
            $category_id  = $_POST['category_id'];
            $status       = $_POST['status'];
            $access       = $_POST['access'];

            $postData = array(
                'id'          => $id,
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
            return false;
        }
    }


}