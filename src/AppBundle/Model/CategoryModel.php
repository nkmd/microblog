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

    public function getCategoryList() {
        try {
            $sql = "SELECT * FROM category ORDER BY `slug` ";
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
