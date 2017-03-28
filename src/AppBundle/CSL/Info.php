<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 17:30
 */

namespace AppBundle\CSL;


class Info
{
    public $title;
    public $id;
    public $authors = array();
    public $links = array();

    function __construct(\DOMElement $dom_node)
    {
        $name = array();
        foreach ($dom_node->childNodes as $node) {
            if ($node->nodeType == 1) {
                switch ($node->nodeName) {
                    case 'author':
                    case 'contributor':
                        foreach ($node->childNodes as $authnode) {
                            if ($node->nodeType == 1) {
                                $name[$authnode->nodeName] = $authnode->nodeValue;
                            }
                        }
                        $this->authors[] = $name;
                        break;
                    case 'link':
                        foreach ($node->attributes as $attribute) {
                            $this->links[] = $attribute->value;
                        }
                        break;
                    default:
                        $this->{$node->nodeName} = $node->nodeValue;
                }
            }
        }

    }
}