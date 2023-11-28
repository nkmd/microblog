<?php
/**
 *  модель AddArticle
 */
namespace AppBundle\Model;
use Doctrine\DBAL\Connection;

class AddArticleModel
{
    private $connection;
    public function __construct(Connection $dbalConnection)  {
        $this->connection = $dbalConnection;
    }

    public function addArticle($addArticle) {
//        $session_id = $addArticle['session_id'];
//        $category  = $addArticle['category'];
//        $status    = $addArticle['status'];
//        $access    = $addArticle['access'];
//        $date      = $addArticle['date'];
//        $title     = $addArticle['title'];
//        $content   = $addArticle['content'];

        //return $addArticle;

        try {
            //$sql = "INSERT INTO articles(title, content) VALUES(title = :title, content = :content)";
            //$sql = "INSERT INTO articles(title, content, date, author_id, status, access) VALUES('aaa4', 'aaa aaa aaa', '2023-12-01', 1, 'test', 'guest')";
            $sql = "INSERT INTO articles(title, content, date, author_id, status, access) VALUES(:title, :content, :date, :author_id, :status, :access)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue('title',   $addArticle['title']);
            $stmt->bindValue('content', $addArticle['content']);
            $stmt->bindValue('date', $addArticle['date']);
            $stmt->bindValue('author_id', $addArticle['session_id']);
            $stmt->bindValue('status', $addArticle['status']);
            $stmt->bindValue('access', $addArticle['access']);
            $stmt->execute();
//            var_dump ($stmt);die();

//            $result = $stmt->fetchAll();
            $result = 'Ok insert';
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
        }
        return $result;
    }

}

//$login = $checkResponse['login'];
//$pass  = $checkResponse['pass'];
//try {
//    $sql = "SELECT * FROM users WHERE login = :login AND pass = :pass";
//    $stmt = $this->connection->prepare($sql);
//    $stmt->bindValue("login", $login);
//    $stmt->bindValue("pass", $pass);
//    $stmt->execute();
//    $result = $stmt->fetchAll();