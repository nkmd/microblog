<?php
/**
 *  модель SearchPage
 */
namespace AppBundle\Model;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class SearchModel
{
    private $container;

    public function __construct(Container $container)  {
        $this->container = $container;
    }

    public function getData($checkResponse) {
//        $sql    = "SELECT * FROM articles LEFT JOIN category ON articles.category_id = category.id WHERE `title` LIKE '%{$checkResponse}%' ORDER BY articles.date DESC ";
        $sql    = "SELECT A.id, A.title, A.content, A.date, A.author_id, A.status, A.access, A.category_id,
                   C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug
                   FROM articles AS A
                   LEFT JOIN category AS C
                   ON A.category_id = C.id
                   WHERE A.title LIKE '%{$checkResponse}%'
                   ORDER BY A.date DESC";
        $conn   = $this->container->get('database_connection');
        $result = $conn->fetchAll($sql);
        return $result;
    }
}

/*
SELECT A.id, A.title, A.content, A.date, A.author_id, A.status, A.access, A.category_id,
C.id AS cat_id, C.name AS cat_name, C.slug AS cat_slug

FROM articles AS A
LEFT JOIN category AS C
ON A.category_id = C.id
ORDER BY A.date DESC LIMIT 6

U.id AS usr_id, U.name AS usr_name, U.login AS usr_login, U.pass AS usr_pass, U.role AS usr_role
LEFT JOIN users AS U
*/