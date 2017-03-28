<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 16:20
 */

namespace AppBundle\CSL;


class Macros extends Collection
{

    function __construct($macro_nodes, CiteProc $citeproc)
    {
        foreach ($macro_nodes as $macro) {
            $macro = Factory::create($macro, $citeproc);
            $this->elements[$macro->name()] = $macro;
        }
    }

    function render_macro($name, $data, $mode)
    {
        return $this->elements[$name]->render($data, $mode);
    }
}