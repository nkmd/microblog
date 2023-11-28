<?php
/**
 *  проверка данных CategoryPage
 */

namespace AppBundle\Service;

class CategoryService
{
    public function checkData($category) {
        $sanitize = '';

        if (isset($category)) {
            $sanitize = (int) abs($category);
        }

        return $sanitize;
    }

}