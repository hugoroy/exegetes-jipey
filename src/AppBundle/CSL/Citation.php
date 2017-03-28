<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 16:21
 */

namespace AppBundle\CSL;


class Citation extends Format
{
    /**
     * @var Layout
     */
    private $layout = null;

    function init(\DOMElement $dom_node, CiteProc $citeproc)
    {
        $options = $dom_node->getElementsByTagName('option');
        foreach ($options as $option) {
            $value = $option->getAttribute('value');
            $name = $option->getAttribute('name');
            $this->attributes[$name] = $value;
        }

        $layouts = $dom_node->getElementsByTagName('layout');
        foreach ($layouts as $layout) {
            $this->layout = new Layout($layout, $citeproc);
        }
    }

    function render($data, $mode = null)
    {
        $this->citeproc->quash = array();

        $text = $this->layout->render($data, 'citation');

        return $this->format($text);
    }

}