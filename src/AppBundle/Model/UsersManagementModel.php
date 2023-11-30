<?php
/**
 *  модель UsersManagement
 */
namespace AppBundle\Model;
use Doctrine\DBAL\Connection;

class UsersManagementModel
{
    private $connection;
    public function __construct(Connection $dbalConnection)  {
        $this->connection = $dbalConnection;
    }

    public function getUsersList() {
        try {
            $sql = "SELECT U.id AS usr_id, U.name AS usr_name, U.login AS usr_login, U.pass AS usr_pass, U.role AS usr_role
                    FROM users AS U
                    ORDER BY U.name";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
        }
        return $result;

    }

    public function updateUser($data) {
        $usr_id     = $data['usr_id'];
        $usr_name   = $data['usr_name'];
        $usr_login  = $data['usr_login'];
        $usr_pass   = $data['usr_pass'];
        $usr_role   = $data['$usr_role'];

        try {
            $sql = "UPDATE users SET name = :name, login = :login, pass = :pass, role = :role WHERE id = :id ";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue("id",    $usr_id);
            $stmt->bindValue("name",  $usr_name);
            $stmt->bindValue("login", $usr_login);
            $stmt->bindValue("pass",  $usr_pass);
            $stmt->bindValue("role",  $usr_role);
            $stmt->execute();
            //$result = $stmt->fetchAll();
            $result = 'Ok update';
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
        }
        return $result;

    }



}
