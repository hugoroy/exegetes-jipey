<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 29/03/2017
 * Time: 16:08
 */

namespace AppBundle\Entity;


class Name
{

    /**
     * @var string
     */
    public $family;

    /**
     * @var string
     */
    public $given;

    /**
     * @var string
     */
    public $doppingParticule;

    /**
     * @var string
     */
    public $nonDroppingParticule;

    /**
     * @var string
     */
    public $suffix;

    /**
     * @var string|int|bool
     */
    public $commaSuffix;

    /**
     * @var string|int|bool
     */
    public $staticOrdering;

    /**
     * @var string
     */
    public $literal;

    /**
     * @var string|int|bool
     */
    public $parseNames;
}