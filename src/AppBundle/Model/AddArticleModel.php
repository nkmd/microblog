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

    public function insertArticle($addData) {
        $title        = $addData['title'];
        $content      = $addData['content'];
        $date         = $addData['date'];
        $author_id    = $addData['author_id'];
        $category_id  = $addData['category_id'];
        $status       = $addData['status'];
        $access       = $addData['access'];
        try {
            $sql = "INSERT INTO articles(title, content, date, author_id, category_id, status, access) VALUES(:title, :content, :date, :author_id, :category_id, :status, :access)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue('title', $title);
            $stmt->bindValue('content', $content);
            $stmt->bindValue('date', $date);
            $stmt->bindValue('author_id', $author_id);
            $stmt->bindValue('category_id', $category_id);
            $stmt->bindValue('status', $status);
            $stmt->bindValue('access', $access);
            $stmt->execute();
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