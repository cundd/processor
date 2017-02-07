<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 7.2.17
 * Time: 13:46
 */

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
