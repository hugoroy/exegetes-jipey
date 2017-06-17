<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 14/06/2017
 * Time: 15:17
 */

namespace AppBundle\Entity;


use AppBundle\Serializer\DateDenormalizer;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Yaml\Yaml;

class ReferenceManger
{
    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @var string
     */
    protected $storageFilename;

    /**
     * @var Reference[]
     */
    protected $references;

    public function __construct($storageFilename)
    {
        $normalizers = [
            new DateDenormalizer(),
            new ObjectNormalizer(null, null, null, new PhpDocExtractor()),
            new ArrayDenormalizer(),
        ];
        $encoders    = [
            new YamlEncoder(
                null,
                null,
                [
                    'yaml_flags'  => Yaml::PARSE_OBJECT_FOR_MAP,
                    'yaml_inline' => 2,
                ]
            ),
        ];

        $this->serializer = new Serializer($normalizers, $encoders);
        $this->storageFilename = $storageFilename;
    }

    /**
     * @return Reference[]
     */
    public function findAll()
    {
        $references = $this->getReferences();

        return $references;
    }

    public function find($id)
    {
        $references = $this->getReferences();

        foreach ($references as $reference) {
            if ($reference->id === $id) {
                return $reference;
            }
        }

        return null;
    }

    /**
     * @return Reference[]
     */
    public function getReferences()
    {
        if ($this->references === null) {
            $data = file_get_contents($this->storageFilename);
            /** @var References $references */
            $this->references = $this->serializer->deserialize($data, 'AppBundle\\Entity\\References', 'yaml');
        }

        return $this->references->getReferences();
    }

    public function persist(Reference $reference)
    {
        /** @var ArrayCollection $references */
        $references = $this->getReferences();
        // Has object are always passed by reference
        if ($references->contains($reference)) {
            return true;
        }

        return $references->add($reference);
    }

    public function remove(Reference $reference)
    {
        /** @var ArrayCollection $references */
        $references = $this->getReferences();

        return $references->removeElement($reference);
    }

    public function flush()
    {
        if ($this->references !== null) {
            $out = $this->serializer->serialize($this->references, 'yaml');
            file_put_contents($this->storageFilename, $out);
        }
    }

    public function clear()
    {
        $this->references = null;
    }
}