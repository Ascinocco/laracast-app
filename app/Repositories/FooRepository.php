<?php
/**
 * Created by PhpStorm.
 * User: anthony
 * Date: 2015-10-27
 * Time: 17:18
 */

namespace App\Repositories;


class FooRepository
{
    public function get()
    {
        //this would normally be an eloquent query
        return ['array', 'of', 'items'];
    }
}