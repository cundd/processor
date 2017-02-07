<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 22.12.16
 * Time: 14:44
 */

namespace Cundd\Processor\Command;

use Cundd\Processor\Io\File\Reader\ReaderFactory;
use Cundd\Processor\Kernel\KernelProcessor;
use Iresults\Core\DataObject;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

use Symfony\Component\Console\Output\OutputInterface;

class ReadFileCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('read:file')
            ->setDescription('Read and process a file')
            ->addArgument('kernel', InputArgument::REQUIRED, 'Script to run')
            ->addArgument('file', InputArgument::REQUIRED, 'File to import the data from')
        ;
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
     * @return DataObject[]|\Traversable
     */
    protected function loadDataFromFile(string $file)
    {
        return ReaderFactory::getReaderForUri($file)->read($file);
    }
}
