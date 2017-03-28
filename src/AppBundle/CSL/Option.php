<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 16:21
 */

namespace AppBundle\CSL;


class Option
{
    private $name;
    private $value;

    function get()
    {
        return array($this->name => $this->value);
    }
}