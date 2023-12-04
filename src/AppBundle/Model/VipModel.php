<?php
/**
 *  модель VipPage
 */

namespace AppBundle\Model;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class VipModel
{
    private $container;

    public function __construct(Container $container)  {
        $this->container = $container;
    }

    public function getArticles($userStatus) {
        if($userStatus == 'admin'){
            $sql = "SELECT A.id, A.title, A.content, A.date, A.author_id, A.status, A.access, A.category_id, 
                    C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug
                    FROM articles AS A
                    LEFT JOIN category AS C
                    ON A.category_id = C.id
                    WHERE A.access = 'vip'
                    ORDER BY A.date
                    ";
        } elseif ($userStatus == 'vip'){
            $sql = "SELECT A.id, A.title, A.content, A.date, A.author_id, A.status, A.access, A.category_id, 
                    C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug
                    FROM articles AS A
                    LEFT JOIN category AS C
                    ON A.category_id = C.id
                    WHERE A.status = 'published' AND A.access = 'vip'
                    ORDER BY A.date
                    ";
        } else {
            header("Location: /blog");
            exit;
        }

        $conn = $this->container->get('database_connection');
        $result= $conn->fetchAll($sql);
        return $result;
    }

    public function getArticlesByCategory($category, $userStatus) {
        if($userStatus == 'admin') {
            $sql = "SELECT A.id, A.title, A.content, A.date, A.author_id, A.status, A.access, A.category_id,
                C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug
                FROM articles AS A
                LEFT JOIN category AS C
                ON A.category_id = C.id
                WHERE '$category' = A.category_id AND A.access = 'vip'
                ORDER BY A.date DESC";
        } elseif ($userStatus == 'vip') {
            $sql = "SELECT A.id, A.title, A.content, A.date, A.author_id, A.status, A.access, A.category_id,
                C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug
                FROM articles AS A
                LEFT JOIN category AS C
                ON A.category_id = C.id
                WHERE '$category' = A.category_id  AND A.status = 'published' AND A.access = 'vip'
                ORDER BY A.date DESC";
        } else {
            header("Location: /blog");
            exit;
        }

        $conn = $this->container->get('database_connection');
        $result= $conn->fetchAll($sql);
        return $result;
    }

}
