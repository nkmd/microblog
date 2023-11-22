<?php
/**
 *  модель LoginPage
 */
namespace AppBundle\Model;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class LoginModel
{
    private $container;

    public function __construct(Container $container)  {
        $this->container = $container;
    }

    public function getData($checkResponse) {
        $sql    = "SELECT * FROM articles WHERE `title` LIKE '%{$checkResponse}%' ";
        $conn   = $this->container->get('database_connection');
        $result = $conn->fetchAll($sql);
        return $result;
    }
}