<?php

namespace AppBundle\Command;

use Json\Validator;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
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
        $container = $this->getContainer();
        $root = $container->get('kernel')->getRootDir();
        $schema = $root . '/Resources/schema/csl/csl-data-custom.json';
        $filename = $root . '/data/references.yaml';
        $data = Yaml::parse(file_get_contents($filename));
        $refs = [];
        $refs['root'] = [];
        $validator = new Validator($schema);

        foreach ($data['references'] as $ref) {
            $obj = (object) $ref;
            $refs['root'][] = $obj;
        }
        dump($validator->validate($refs['root']));

    }
}
