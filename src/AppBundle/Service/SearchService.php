<?php

namespace AppBundle\Service;
use AppBundle\Model\BlogModel as ArticlesMod;

class SearchService
{
    public function articlesList()
    {
        $instance = new ArticlesMod();
        $data = $instance -> model();
        return  'answer Im Service List | ' . $data;
    }
}