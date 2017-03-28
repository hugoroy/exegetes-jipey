<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 16:22
 */

namespace AppBundle\CSL;


class Choose extends Element
{

    function render($data, $mode = null)
    {
        foreach ($this->elements as $choice) {
            if ($choice->evaluate($data)) {
                return $choice->render($data, $mode);
            }
        }
    }
}