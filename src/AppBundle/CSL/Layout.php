<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 16:20
 */

namespace AppBundle\CSL;


class Layout extends Format
{

    function init_formatting()
    {
        $this->div_class = 'csl-entry';
        parent::init_formatting();
    }

    function render($data, $mode = null)
    {
        $text = '';
        $parts = array();
        // $delimiter = $this->delimiter;

        foreach ($this->elements as $element) {
            $parts[] = $element->render($data, $mode);
        }

        $text = implode($this->delimiter, $parts);

        if ($mode == 'bibliography' || $mode == 'citation') {
            return $this->format($text);
        } else {
            return $text;
        }

    }

}