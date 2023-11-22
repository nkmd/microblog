<?php
// src/AppBundle/Model/Test.php

namespace AppBundle\Model;

use Doctrine\DBAL\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class Test
{
//    private $container;
//    public function __construct(Container $container)  {
//        $this->container = $container;
//    }

    private $connection;
    public function __construct(Connection $dbalConnection)  {
        $this->connection = $dbalConnection;
    }

//    public function getCount() {
//        $sql = "SELECT count(*) FROM users";
//        $conn = $this->container->get('database_connection');
//        $aa = $conn->fetchColumn($sql);
//
//        return $aa;
//    }

    public function getData() {
        $conn = $this->connection;
        $name = 'Nikolay';
        try {
            $sql = "SELECT * FROM users WHERE name = :name LIMIT 5";
            $stmt = $conn->prepare($sql);
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