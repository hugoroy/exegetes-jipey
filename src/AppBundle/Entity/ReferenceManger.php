<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 14/06/2017
 * Time: 15:17
 */

namespace AppBundle\Entity;


use AppBundle\Serializer\DateDenormalizer;
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
     * @var References
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
                ['yaml_flags'  => Yaml::PARSE_OBJECT_FOR_MAP,
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

        return $references->references;
    }

    public function getReferences()
    {
        if ($this->references === null) {
            $data = file_get_contents($this->storageFilename);
            $this->references = $this->serializer->deserialize($data, 'AppBundle\\Entity\\References', 'yaml');
        }

        return $this->references;
    }
}