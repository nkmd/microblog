<?php
// src/AppBundle/Controller/TestController.php

/**

 *  Обращение http://localhost:8000/test
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Doctrine\DBAL\DriverManager;

class TestController extends Controller
{
    // маршрут
    /**
     * @Route("/test" , name="test")
     */
    public function numberAction()
    {

        $conn = $this->get('database_connection');
        $result = $conn->fetchAll('SELECT * FROM users');

        var_dump($result);

//        foreach ($result as $key => $item) {
//            echo $item['id'];
//            echo $item['name'];
//            echo $item['phone'];
//            echo $item['description'];
//            echo '<br>';
//        }
        //return new JsonResponse($result);
        die();





//        $conn = $this->get('database_connection');
//
//        $sql = "SELECT * FROM users";
//        $stmt = $conn->query($sql); // Simple, but has several drawbacks
//
//        var_dump($stmt);




//        $data = array(

//        );

        // контроллер, отрисовка с помощью шаблона "/app/Resources/views/blog/index.html.twig"
        //return $this->render('blog/index.html.twig', array('data' => $data));
    }
}