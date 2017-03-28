<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 16:13
 */

namespace AppBundle\CSL;


class Factory
{
    public static function create(\DOMElement $dom_node, CiteProc $citeproc = null)
    {
        $class_name = __NAMESPACE__.'\\'. str_replace('-', '', $dom_node->nodeName);
        if (class_exists($class_name)) {
            return new $class_name($dom_node, $citeproc);
        } else {
            return null;
        }
    }
}