<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 16:14
 */

namespace AppBundle\CSL;


class RenderingElement extends Element
{

    function render($data, $mode = null)
    {
        $text = '';
        $text_parts = array();

        $delim = $this->delimiter;
        foreach ($this->elements as $element) {
            $text_parts[] = $element->render($data, $mode);
        }
        $text = implode($delim, $text_parts); // insert the delimiter if supplied.

        return $this->format($text);
    }

}