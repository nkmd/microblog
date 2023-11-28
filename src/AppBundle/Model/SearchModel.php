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
        $sql    = "SELECT * FROM articles LEFT JOIN category ON articles.category_id = category.id WHERE `title` LIKE '%{$checkResponse}%' ORDER BY articles.date DESC ";
        $conn   = $this->container->get('database_connection');
        $result = $conn->fetchAll($sql);
        return $result;
    }
}