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

    public function getUserById($category) {
//            try {
//                //$sql = "SELECT * FROM category WHERE '$category' = `id` ";
//                $sql = "SELECT C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug
//                        FROM category AS C
//                        WHERE '$category' = C.slug
//                        ORDER BY C.slug";
//                $stmt = $this->connection->prepare($sql);
//                $stmt->execute();
//                $result = $stmt->fetchAll();
//            } catch (\Exception $e) {
//                var_dump($e->getMessage());
//                exit;
//            }
//            return $result;
            return '__getUserById';
        }



}
