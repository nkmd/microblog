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

        public function getArticle($articleId) {
            try {
//                $sql = "SELECT * FROM articles WHERE '$articleId' = `id` ";
                $sql = "SELECT A.id, A.title, A.content, A.date, A.author_id, A.status, A.access, A.category_id, 
                    C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug
                    FROM articles AS A
                    LEFT JOIN category AS C
                    ON A.category_id = C.id
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

}

