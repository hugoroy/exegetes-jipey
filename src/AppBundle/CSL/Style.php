<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 16:22
 */

namespace AppBundle\CSL;


class Style extends Element
{

    function __construct(\DOMElement $dom_node = null, CiteProc $citeproc = null)
    {
        if ($dom_node) {
            $this->set_attributes($dom_node);
        }
    }
}