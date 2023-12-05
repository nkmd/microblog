<?php
/**
 *  модель HomePage
 */
namespace AppBundle\Model;
use Doctrine\DBAL\Connection;

class HomeModel
{
    private $connection;
    public function __construct(Connection $dbalConnection)  {
        $this->connection = $dbalConnection;
    }

    public function getArticles($userStatus) {
        try {
            if($userStatus == 'admin'){
                $sql = "SELECT A.id, A.title, A.content, A.date, A.author_id, A.status, A.access, A.category_id, 
                    C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug
                    FROM articles AS A
                    LEFT JOIN category AS C
                    ON A.category_id = C.id
                    ORDER BY A.date DESC LIMIT 6
                    ";
            } elseif ($userStatus == 'vip'){
                $sql = "SELECT A.id, A.title, A.content, A.date, A.author_id, A.status, A.access, A.category_id, 
                    C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug
                    FROM articles AS A
                    LEFT JOIN category AS C
                    ON A.category_id = C.id
                    WHERE A.status = 'published'
                    ORDER BY A.date DESC LIMIT 6
                    ";
            } else {
                $sql = "SELECT A.id, A.title, A.content, A.date, A.author_id, A.status, A.access, A.category_id, 
                    C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug
                    FROM articles AS A
                    LEFT JOIN category AS C
                    ON A.category_id = C.id
                    WHERE A.access != 'vip' AND A.status = 'published'
                    ORDER BY A.date DESC LIMIT 6
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
