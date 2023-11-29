<?php
/**
 *  проверка данных ArticlePage
 */

namespace AppBundle\Service;

class ArticleService
{
    public function checkData($articleId) {
        $sanitize = '';

        if (isset($articleId)) {
            $sanitize = (int) abs($articleId);
        }

        return $sanitize;
    }
}