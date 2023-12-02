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

    public function updateCategory($data) {
        $cat_id            = $data['cat_id'];
        $cat_name          = $data['cat_name'];
        $cat_slug          = $data['cat_slug'];
        $cat_slug_current  = $data['cat_slug_current'];

        // если не меняет логин, либо логин не "занят":
        $existSlug = $this->getCategoryBySlug($cat_slug);

        if ($cat_slug === $cat_slug_current || !$existSlug) {
            try {
                $sql = "UPDATE category SET name = :name, slug = :slug WHERE id = :id ";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue("id",   $cat_id);
                $stmt->bindValue("name", $cat_name);
                $stmt->bindValue("slug", $cat_slug);
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

    public function deleteCategory($cat_id) {
        try {
            $sql = "DELETE FROM category WHERE id = :id ";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue("id", $cat_id);
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
