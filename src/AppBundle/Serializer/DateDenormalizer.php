<?php

namespace AppBundle\Serializer;

use AppBundle\Entity\Date;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\scalar;

/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 13/06/2017
 * Time: 12:38
 */
class DateDenormalizer implements DenormalizerInterface, NormalizerInterface
{

    /**
     * Denormalizes data back into an object of the given class.
     *
     * @param mixed $data data to restore
     * @param string $class the expected class to instantiate
     * @param string $format format the given data was extracted from
     * @param array $context options available to the denormalizer
     *
     * @return object
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $dateFormatMap = ['year' => 'Y', 'month' => 'm', 'day' => 'd'];
        $dateElements = [];
        $formatElements = [];
        $dateSeparator = '-';
        foreach ($dateFormatMap as $name => $partFormat) {
            if (isset($data->{$name})) {
                $formatElements[] = $partFormat;
                $dateElements[]   = $data->{$name};
            }
        }

        return \DateTime::createFromFormat(
            implode($dateSeparator, $formatElements).'|',
            implode($dateSeparator, $dateElements)
        );
    }

    /**
     * Checks whether the given class is supported for denormalization by this normalizer.
     *
     * @param mixed $data Data to denormalize from
     * @param string $type The class to which the data should be denormalized
     * @param string $format The format being deserialized from
     *
     * @return bool
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === Date::class;
    }

    /**
     * Normalizes an object into a set of arrays/scalars.
     *
     * @param \DateTime $object object to normalize
     * @param string $format format the normalization result will be encoded as
     * @param array $context Context options for the normalizer
     *
     * @return array|scalar
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return [
            'year' => $object->format('Y'),
            'month' => $object->format('m'),
            'day' => $object->format('d'),
        ];
    }

    /**
     * Checks whether the given class is supported for normalization by this normalizer.
     *
     * @param mixed $data Data to normalize
     * @param string $format The format being (de-)serialized from or into
     *
     * @return bool
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof \DateTime;
    }
}