<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class PurgeMp3FilesCommand extends ContainerAwareCommand {

    protected function configure() {
        $this->setName('taken:purge-mp3')
            ->setDescription('Sends the daily digest email')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $webDir = realpath($this->getContainer()->getParameter('kernel.root_dir') . '/../web/');

        if ($handle = opendir($webDir)) {
            while (false !== ($file = readdir($handle)))
            {
                if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'mp3')
                {
                    $mp3Files[] = $file;
                }
            }
            closedir($handle);
        }

        foreach($mp3Files as $file){
            unlink($webDir.'/'. $file);
        }

    }

}