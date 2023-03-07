<?php
declare(strict_types=1);

namespace Cundd\Processor\Io;

use Traversable;

interface ReaderInterface
{
    /**
     * Read the file from the given URI and returns a traversable version of the data
     *
     * @param string $uri
     * @return Traversable
     */
    public function read(string $uri): Traversable;
}
