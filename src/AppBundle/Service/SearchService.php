<?php
/**
 *  проверка данных SearchPage
 */
namespace AppBundle\Service;

class SearchService
{
    public function checkData($query) {
        $data = trim(htmlspecialchars(htmlentities($query, ENT_QUOTES )));
        return $data;
    }
}