<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 16:24
 */

namespace AppBundle\CSL;


class CondElse extends CondIf
{

    function evaluate($data = null)
    {
        return true; // the last else always returns TRUE
    }
}
