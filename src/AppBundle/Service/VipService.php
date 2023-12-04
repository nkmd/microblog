<?php
/**
 *  проверка данных VipPage
 */

namespace AppBundle\Service;

class VipService
{
    public function checkData($categoryId) {
        $sanitize = '';

        if (isset($categoryId)) {
            $sanitize = (int) abs($categoryId);
        }

        return $sanitize;
    }

}