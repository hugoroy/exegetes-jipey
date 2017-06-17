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
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Yaml\Yaml;

class ReferenceManger extends EntityRepository
{
    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @var Reference[]
     */
    protected $references;

    public function __construct($em, ClassMetadata $class)
    {
        parent::__construct($em, $class);
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
    }

    public function persist(Reference $reference)
    {
        $this->_em->persist($reference);
        $this->_em->flush();
    }

    public function remove(Reference $reference)
    {
        $this->_em->remove($reference);
        $this->_em->flush();
    }

    public function loadFromFile($filename)
    {
        $data = file_get_contents($filename);
        /** @var References $references */
        $references = $this->serializer->deserialize($data, 'AppBundle\\Entity\\References', 'yaml');
        foreach ($references->references as $reference) {
            $this->_em->persist($reference);
        }
        $this->_em->flush();
    }

    public function dumpYAML()
    {
        $references = $this->findAll();
        $references = new References($references);

        return $this->serializer->serialize($references, 'yaml');
    }

    public function serialize($data, $format)
    {
        return $this->serializer->serialize($data, $format);
    }
}