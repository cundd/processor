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
use LogicException;
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
        if ($output->getVerbosity() > OutputInterface::VERBOSITY_NORMAL) {
            $output->writeln('Read file: ' . $file);
        }

        $data = $this->loadDataFromFile($file);

        $processor = new Processor();

        $processor
            ->process(
                'map',
                function (DataObject $row) {

                    $newRow = clone($row);
                    $newRow['tstamp'] = strtotime($row['tstamp']);
                    $newRow['crdate'] = strtotime($row['crdate']);

                    return $newRow;
                }
            )
            ->process(
                'map',
                function (DataObject $row) {
                    $mem = fopen('php://memory', 'r+');
                    fputcsv($mem, $row->toArray());
                    rewind($mem);

                    return trim(stream_get_contents($mem));
                }
            )
            ->process('implode', [PHP_EOL])
        ->process('print');

        $processor->run($data);


        return 0;
    }

    /**
     * Load the data
     *
     * @param string $file
     * @return DataObject[]
     */
    protected function loadDataFromFile(string $file)
    {
        return \Iresults\Core\DataObject\Factory::collectionFromCsvUrl($file);
    }
}
