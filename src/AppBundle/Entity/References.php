<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 13/06/2017
 * Time: 11:59
 */

namespace AppBundle\Entity;


class References
{
    /**
     * @var Reference[]
     */
    public $references;

    /**
     * References constructor.
     * @param \AppBundle\Entity\Reference[] $ref
     */
    public function __construct($ref = [])
    {
        $this->references = $ref;
    }
}