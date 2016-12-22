<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 22.12.16
 * Time: 14:44
 */

namespace Cundd\Processor\Command;

use Cundd\Processor\Processor;
use Cundd\Processor\Util;
use Iresults\Core\DataObject;
use Iresults\Core\Iresults;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

use Symfony\Component\Console\Output\OutputInterface;

//Iresults::forceDebug();

class ReadFileCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('read:file')
            ->setDescription('Read and process a file')
            ->addArgument('file', InputArgument::REQUIRED, 'File to read');
    }

    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return null|int null or 0 if everything went fine, or an error code
     *
     * @throws LogicException When this abstract method is not implemented
     *
     * @see setCode()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');
        $output->writeln('Read file: ' . $file);

        $data = \Iresults\Core\DataObject\Factory::collectionFromCsvUrl($file);
//        $data = array_slice(Util::collection($data)->getArrayCopy(), -1);


        $processor = new Processor();
        $processor->process('map', $processor->createProcess('collect', 'aufmerksam'));

        $processor->process('transform', 'array');
        $processor->process('array_count_values');

        $processor->run($data);
        var_dump(($processor->getLastOutput()));


        return 0;
    }
}