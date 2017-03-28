<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 16:21
 */

namespace AppBundle\CSL;


class Bibliography extends Format
{
    /**
     * @var Layout
     */
    private $layout = null;

    function init(\DOMElement $dom_node, CiteProc $citeproc)
    {
        $hier_name_attr = $this->get_hier_attributes();
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

    function init_formatting()
    {
        $this->div_class = 'csl-bib-body';
        parent::init_formatting();
    }

    function render($data, $mode = null)
    {
        $this->citeproc->quash = array();
        $text = $this->layout->render($data, 'bibliography');
        if ($this->{'hanging-indent'} == 'true') {
            $text = '<div style="  text-indent: -25px; padding-left: 25px;">'.$text.'</div>';
        }
        $text = str_replace('?.', '?', str_replace('..', '.', $text));

        return $this->format($text);
    }
}