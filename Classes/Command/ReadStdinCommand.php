<?php
declare(strict_types=1);

namespace Cundd\Processor\Command;

use ArrayIterator;
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

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $kernel = $input->getArgument('kernel');

        $data = $this->readStdin();
        $kernelProcessor = new KernelProcessor();
        $kernelProcessor->executeKernel($kernel, $data);

        return 0;
    }

    private function readStdin(): ArrayIterator
    {
        $input = [];
        while ($line = fgets(STDIN)) {
            $input[] = $line;
        }

        return new ArrayIterator($input);
    }
}
