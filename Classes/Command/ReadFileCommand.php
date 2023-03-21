<?php
declare(strict_types=1);

namespace Cundd\Processor\Command;

use Cundd\Processor\Io\File\Reader\ReaderFactory;
use Cundd\Processor\Kernel\KernelProcessor;
use Iresults\Core\DataObject;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Traversable;

class ReadFileCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('read:file')
            ->setDescription('Read and process a file')
            ->addArgument('kernel', InputArgument::REQUIRED, 'Script to run')
            ->addArgument('file', InputArgument::REQUIRED, 'File to import the data from');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $file = $input->getArgument('file');
        $kernel = $input->getArgument('kernel');
        if ($output->getVerbosity() > OutputInterface::VERBOSITY_NORMAL) {
            $output->writeln('Read file: ' . $file);
        }

        $data = $this->loadDataFromFile($file);
        $kernelProcessor = new KernelProcessor();
        $kernelProcessor->executeKernel($kernel, $data);

        return 0;
    }

    /**
     * Load the data
     *
     * @param string $file
     * @return DataObject[]|Traversable
     */
    private function loadDataFromFile(string $file): Traversable
    {
        return ReaderFactory::getReaderForUri($file)->read($file);
    }
}
