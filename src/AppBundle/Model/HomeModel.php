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

    public function getData() {
        $name = 'Nikolay';
        try {
            $sql = "SELECT * FROM users WHERE name = :name LIMIT 5";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue("name", $name);
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
        }
        return $result;
    }

}
