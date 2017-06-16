<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 13/06/2017
 * Time: 11:59
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class References
{
    /**
     * This is a hack for serialization, because references are stored into elements attribute
     * @var Reference[]
     */
    private $references;

    /**
     * @return ArrayCollection
     */
    public function getReferences()
    {
        return $this->references;
    }


    public function setReferences($collection)
    {
        $this->references = new ArrayCollection($collection);
    }
}