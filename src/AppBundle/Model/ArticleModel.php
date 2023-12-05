<?php
/**
 *  модель ArticlePage
 */

namespace AppBundle\Model;

use Doctrine\DBAL\Connection;

class ArticleModel
{
    private $connection;

    public function __construct(Connection $dbalConnection)  {
        $this->connection = $dbalConnection;
    }

    public function getArticle($articleId, $userStatus) {

        try {
            if($userStatus == 'admin'){
                $sql = "SELECT A.id, A.title, A.content, A.date, A.author_id, A.status, A.access, A.category_id, 
                C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug
                FROM articles AS A
                LEFT JOIN category AS C
                ON A.category_id = C.id
                WHERE '$articleId' = A.id
                ";
            } elseif ($userStatus == 'vip'){
                $sql = "SELECT A.id, A.title, A.content, A.date, A.author_id, A.status, A.access, A.category_id, 
                C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug
                FROM articles AS A
                LEFT JOIN category AS C
                ON A.category_id = C.id
                WHERE '$articleId' = A.id AND A.status = 'published'
                ";
            } else {
                $sql = "SELECT A.id, A.title, A.content, A.date, A.author_id, A.status, A.access, A.category_id, 
                C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug
                FROM articles AS A
                LEFT JOIN category AS C
                ON A.category_id = C.id
                WHERE '$articleId' = A.id AND A.access != 'vip' AND A.status = 'published'
                ";
            }

            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
        }
        return $result;
    }

}

