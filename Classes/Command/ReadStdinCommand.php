<?php

namespace Cundd\Processor\Command;

use Cundd\Processor\Kernel\KernelProcessor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReadStdinCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('read:stdin')
            ->setDescription('Read and process from STDIN')
            ->addArgument('kernel', InputArgument::REQUIRED, 'Script to run');
    }

    /**
     * Executes the current command
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return null|int null or 0 if everything went fine, or an error code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $kernel = $input->getArgument('kernel');

        $data = $this->readStdin();
        $kernelProcessor = new KernelProcessor();
        $kernelProcessor->executeKernel($kernel, $data);

        return 0;
    }

    /**
     * @return \Traversable
     */
    protected function readStdin()
    {
        $input = [];
        while ($line = fgets(STDIN)) {
            $input[] = $line;
        }

        return new \ArrayIterator($input);
    }
}
