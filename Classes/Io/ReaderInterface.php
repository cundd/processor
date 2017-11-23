<?php

namespace Cundd\Processor\Io;


interface ReaderInterface
{
    /**
     * Reads the file from the given URI and returns a traversable version of the data
     *
     * @param string $uri
     * @return \Traversable
     */
    public function read(string $uri): \Traversable;
}
