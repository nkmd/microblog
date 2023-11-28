<?php
/**
 *  модель BlogPage
 */

namespace AppBundle\Model;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class BlogModel
{
    private $container;

    public function __construct(Container $container)  {
        $this->container = $container;
    }

    public function getArticles() {
        //$sql = "SELECT * FROM articles ORDER BY `date` DESC ";
        $sql = "SELECT * FROM articles LEFT JOIN category ON articles.category_id = category.id ORDER BY articles.date DESC ";
        $conn = $this->container->get('database_connection');
        $result= $conn->fetchAll($sql);
        return $result;
    }

    public function getArticlesByCategory($category) {
        //$sql = "SELECT * FROM articles WHERE '$category' = `category_id` ORDER BY `date` DESC ";
        $sql = "SELECT * FROM articles LEFT JOIN category ON articles.category_id = category.id WHERE '$category' = `category_id`  ORDER BY articles.date DESC ";
        $conn = $this->container->get('database_connection');
        $result= $conn->fetchAll($sql);
        return $result;
    }

}


/* ----------------------------------------------------



*/