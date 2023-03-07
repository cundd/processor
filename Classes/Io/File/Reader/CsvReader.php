<?php
declare(strict_types=1);

namespace Cundd\Processor\Io\File\Reader;

use ArrayIterator;
use Cundd\Processor\Io\ReaderInterface;
use Iresults\Core\DataObject\Factory;
use Traversable;

/**
 * Reader implementation for CSV files
 */
class CsvReader implements ReaderInterface
{
    /**
     * Reads the file from the given URI and returns a traversable version of the data
     *
     * @param string $uri
     * @return Traversable
     */
    public function read(string $uri): Traversable
    {
        return new ArrayIterator(Factory::collectionFromCsvUrl($uri));
    }
}
