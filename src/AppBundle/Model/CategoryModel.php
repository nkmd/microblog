<?php
/**
 *  модель Category
 */
namespace AppBundle\Model;
use Doctrine\DBAL\Connection;

class CategoryModel
{
    private $connection;
    public function __construct(Connection $dbalConnection)  {
        $this->connection = $dbalConnection;
    }

    public function getCategoryById($category) {
        try {
            $sql = "SELECT C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug
                    FROM category AS C
                    WHERE '$category' = C.slug
                    ORDER BY C.slug";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
        }
        return $result;
    }

    public function getCategoryList() {
        try {
            $sql = "SELECT C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug
                    FROM category AS C
                    ORDER BY C.slug";
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
