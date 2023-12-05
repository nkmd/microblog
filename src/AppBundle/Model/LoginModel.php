<?php
/**
 *  модель LoginPage
 */


namespace AppBundle\Model;
use Doctrine\DBAL\Connection;

class LoginModel
{
    private $connection;
    public function __construct(Connection $dbalConnection)  {
        $this->connection = $dbalConnection;
    }

    public function searchUser($checkResponse) {
        $login = $checkResponse['login'];
        $pass  = $checkResponse['pass'];
        try {
            $sql = "SELECT * FROM users WHERE login = :login AND pass = :pass";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue("login", $login);
            $stmt->bindValue("pass", $pass);
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
        }
        return $result;
    }

}
