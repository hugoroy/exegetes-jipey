<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 16:18
 */

namespace AppBundle\CSL;


class EtAl extends Text
{

    function __construct(\DOMElement $dom_node = null, CiteProc $citeproc = null)
    {
        $this->var = 'et-al';
        $this->source = 'term';
        parent::__construct($dom_node, $citeproc);

    }
}