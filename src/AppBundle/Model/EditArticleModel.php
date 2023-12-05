<?php
/**
 *  модель EditArticle
 */
namespace AppBundle\Model;
use Doctrine\DBAL\Connection;

class EditArticleModel
{
    private $connection;
    public function __construct(Connection $dbalConnection)  {
        $this->connection = $dbalConnection;
    }

    public function getArticleContent($articleId) {
        try {
            $sql = "SELECT A.id, A.title, A.content, A.date, A.author_id, A.category_id, A.status, A.access          
                FROM articles AS A
                WHERE '$articleId' = A.id
                ";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
        }
        return $result;
    }

    public function editArticle($editArticle) {
        $id          = $editArticle['id'];
        $title       = $editArticle['title'];
        $content     = $editArticle['content'];
        $date        = $editArticle['date'];
        $author_id   = $editArticle['author_id'];
        $category_id = $editArticle['category_id'];
        $status      = $editArticle['status'];
        $access      = $editArticle['access'];

        try {
            $sql = "UPDATE articles 
                    SET title = :title, content = :content, date = :date, author_id = :author_id, category_id = :category_id, status = :status, access = :access 
                    WHERE id = :id ";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue('id',         $id);
            $stmt->bindValue('title',      $title);
            $stmt->bindValue('content',    $content);
            $stmt->bindValue('date',       $date);
            $stmt->bindValue('author_id',  $author_id);
            $stmt->bindValue('category_id', $category_id);
            $stmt->bindValue('status', $status);
            $stmt->bindValue('access', $access);
            $stmt->execute();
            $result = 'Ok update';
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
        }
        return $result;
    }

    public function deleteArticle($articleId) {
        try {
            $sql = "DELETE FROM articles WHERE id = :id ";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue("id", $articleId);
            $stmt->execute();
            $result = true;
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
        }
        return $result;
    }

}
