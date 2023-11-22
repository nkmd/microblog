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

    public function getData() {
        $sql = "SELECT * FROM articles";
        $conn = $this->container->get('database_connection');
        $result= $conn->fetchAll($sql);

        return $result;
    }

}


/* ----------------------------------------------------



*/