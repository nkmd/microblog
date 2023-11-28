<?php
/**
 *  проверка данных CategoryPage
 */

namespace AppBundle\Service;

class CategoryService
{
    public function checkData($categoryId) {
        $sanitize = '';

        if (isset($categoryId)) {
            $sanitize = (int) abs($categoryId);
        }

        return $sanitize;
    }

}