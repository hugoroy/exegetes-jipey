<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadReferencesCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:load_references')
            ->addArgument('filename', InputArgument::REQUIRED, 'The YAML file containing references to load.')
            ->setDescription('Load references form YAML file.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $referenceManger = $container->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Reference');

        $filename = $input->getArgument('filename');

        $referenceManger->loadFromFile($filename);
    }
}
