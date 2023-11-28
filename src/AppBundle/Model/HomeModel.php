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

    public function getArticles() {
        try {
            //$sql = "SELECT * FROM articles ORDER BY `date` DESC LIMIT 6";
            $sql = "SELECT * FROM articles LEFT JOIN category ON articles.category_id = category.id ORDER BY articles.date DESC LIMIT 6";
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
