<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 16:13
 */

namespace AppBundle\CSL;


class Collection
{
    protected $elements = array();

    function add_element($elem)
    {
        if (isset($elem)) {
            $this->elements[] = $elem;
        }
    }

    function render($data, $mode = null)
    {
    }

    function format($text)
    {
        return $text;
    }

}