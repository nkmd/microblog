<?php
/**
 *  модель CategoriesManagement
 */
namespace AppBundle\Model;
use Doctrine\DBAL\Connection;

class CategoriesManagementModel
{
    private $connection;
    public function __construct(Connection $dbalConnection)  {
        $this->connection = $dbalConnection;
    }

    public function getCategoriesList() {
        try {
            $sql = "SELECT C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug
                    FROM category AS C
                    ORDER BY C.name";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
        }
        return $result;

    }

    public function getCategoryBySlug($cat_slug) {
        try {
            $sql = "SELECT C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug
                    FROM category AS C
                    WHERE slug = :slug
                   ";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue("slug", $cat_slug);
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
        }
        return $result;

    }

    public function insertCategory($data) {
        $cat_name  = $data['cat_name'];
        $cat_slug  = $data['cat_slug'];

        $existSlug = $this->getCategoryBySlug($cat_slug);

        if(!$existSlug){
            try {
                $sql = "INSERT INTO category(name, slug) VALUES(:name, :slug)";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue("name", $cat_name);
                $stmt->bindValue("slug", $cat_slug);
                $stmt->execute();
                //$result = $stmt->fetchAll();
                $result = 'Ok insert';
            } catch (\Exception $e) {
                var_dump($e->getMessage());
                exit;
            }
            return $result;

        } else {
            return false;
        }

    }

    public function updateUser($data) {
        $usr_id             = $data['usr_id'];
        $usr_name           = $data['usr_name'];
        $usr_login          = $data['usr_login'];
        $usr_login_current  = $data['usr_login_current'];
        $usr_pass           = $data['usr_pass'];
        $usr_role           = $data['usr_role'];

        // если не меняет логин, либо логин не "занят":
        $existLogin = $this->getUserByLogin($usr_login);

        if ($usr_login === $usr_login_current || !$existLogin) {
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
               return true;
            } catch (\Exception $e) {
                var_dump($e->getMessage());
                exit;
            }

        } else {
            return false;
        }
    }

    public function deleteUser($usr_id) {
        try {
            $sql = "DELETE FROM users WHERE id = :id ";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue("id", $usr_id);
            $stmt->execute();
            //$result = $stmt->fetchAll();
            $result = 'Ok delete';
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
        }
        return $result;
    }

}
