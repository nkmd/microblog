<?php
/**
 *  проверка данных AddArticle
 */

namespace AppBundle\Service;

class AddArticleService
{
    public function checkData() {
        $postData = array();

        if (
            isset($_SESSION['login']) && !empty($_SESSION['login']) &&

            isset($_POST['category']) && !empty($_POST['category']) &&
            isset($_POST['status']) && !empty($_POST['status']) &&
            isset($_POST['access']) && !empty($_POST['access']) &&
            isset($_POST['date']) && !empty($_POST['date']) &&

            isset($_POST['title']) && !empty($_POST['title']) &&
            isset($_POST['content']) && !empty($_POST['content'])
        ){
            $session_id = $_SESSION['id'];
            $category = trim(htmlspecialchars(htmlentities($_POST['category'], ENT_QUOTES )));
            $status   = trim(htmlspecialchars(htmlentities($_POST['status'], ENT_QUOTES )));
            $access   = trim(htmlspecialchars(htmlentities($_POST['access'], ENT_QUOTES )));
            $date     = trim(htmlspecialchars(htmlentities($_POST['date'], ENT_QUOTES )));
            $title    = trim(htmlspecialchars(htmlentities($_POST['title'], ENT_QUOTES )));
            $content  = trim(htmlspecialchars(htmlentities($_POST['content'], ENT_QUOTES )));

            $postData = array(
                'session_id' =>  $session_id,
                'category'   => $category,
                'status'     => $status,
                'access'     => $access,
                'date'       => $date,
                'title'      => $title,
                'content'    => $content,
            );

            return $postData;
        } else {
            return $postData;
        }

    }


}