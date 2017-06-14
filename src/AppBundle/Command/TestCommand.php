<?php

namespace AppBundle\Command;

use AppBundle\Serializer\DateDenormalizer;
use Seboettg\CiteProc\CiteProc;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Yaml\Yaml;

class TestCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:test')
            ->setDescription('Hello PhpStorm');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container   = $this->getContainer();
        $root        = $container->get('kernel')->getRootDir();
        $schema      = $root.'/Resources/schema/csl/csl-data-custom.json';
        $filename    = $root.'/data/references.yaml';
        $in          = file_get_contents($filename);
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

        $serializer = new Serializer($normalizers, $encoders);
        $data       = $serializer->deserialize($in, 'AppBundle\\Entity\\References', 'yaml');
        $out        = $serializer->serialize($data, 'yaml');
        file_put_contents($root.'/../result.yml', $out);
        var_dump($out === $in);

        return;
        $data = Yaml::parse(file_get_contents($filename), Yaml::PARSE_OBJECT_FOR_MAP);
        $data = $data->references;
        $this->fixIssued($data);
        /*$refs = [];
        $refs['root'] = [];
        $validator = new Validator($schema);

        foreach ($data['references'] as $ref) {
            $obj = (object) $ref;
            $refs['root'][] = $obj;
        }
        dump($validator->validate($refs['root']));*/

        $style    = file_get_contents($root.'/data/french-legal.csl');
        $citeProc = new CiteProc($style, 'fr-FR');
        $citeProc->init();
        /*$sorting = $citeProc::getContext()->getMacro('sort-key');
        $citeProc::getContext()->setSorting(new Sort());*/
        echo $citeProc->render($data, "bibliography");
    }

    protected function fixIssued(&$data)
    {
        foreach ($data as &$d) {
            if (isset($d->issued)) {
                $dateValues = [];
                $empty      = true;
                foreach ($d->issued as $attr => $value) {
                    if ($value !== null) {
                        $empty = false;
                    }
                    $dateValues[] = [$attr, $value];
                }
                if ($empty) {
                    $d->issued = null;
                    continue;
                }
                $d->issued                 = new \stdClass();
                $d->issued->{'date-parts'} = $dateValues;
            } else {
                $d->issued = null;
            }
        }
    }

}