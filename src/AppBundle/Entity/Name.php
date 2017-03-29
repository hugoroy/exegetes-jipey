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
    protected $family;

    /**
     * @var string
     */
    protected $given;

    /**
     * @var string
     */
    protected $doppingParticule;

    /**
     * @var string
     */
    protected $nonDroppingParticule;

    /**
     * @var string
     */
    protected $suffix;

    /**
     * @var string|int|bool
     */
    protected $commaSuffix;

    /**
     * @var string|int|bool
     */
    protected $staticOrdering;

    /**
     * @var string
     */
    protected $literal;

    /**
     * @var string|int|bool
     */
    protected $parseNames;
}