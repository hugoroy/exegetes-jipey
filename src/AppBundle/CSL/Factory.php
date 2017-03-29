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
        $className = __NAMESPACE__ . '\\' . implode('', array_map(function ($v) {
            return ucfirst($v);
        }, explode('-', $dom_node->nodeName)));

        //$class_name = str_replace('-', '', $dom_node->nodeName);
        if (class_exists($className)) {
            return new $className($dom_node, $citeproc);
        } else {
            return null;
        }
    }
}