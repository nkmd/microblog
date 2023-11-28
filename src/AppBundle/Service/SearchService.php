<?php
/**
 *  проверка данных SearchPage
 */
namespace AppBundle\Service;

class SearchService
{
    public function checkData($searchValue) {
        $data = trim(htmlspecialchars(htmlentities($searchValue, ENT_QUOTES )));
        return $data;
    }
}