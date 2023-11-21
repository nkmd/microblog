<?php

namespace AppBundle\Service;
use AppBundle\Model\BlogModel as BlogMdl;

class BlogService
{
    public function blogResult()
    {
        $instance = new BlogMdl();
        $data = $instance -> model();
        return  'answer Im Service List | ' . $data;
    }
}