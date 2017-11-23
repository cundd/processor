<?php

namespace Cundd\Processor\Io;


interface WriterInterface
{
    /**
     * Writes the content to the given URI
     *
     * @param string       $uri
     * @param string|mixed $content
     * @return bool Returns if the resource was written
     */
    public function write(string $uri, $content): bool;
}
