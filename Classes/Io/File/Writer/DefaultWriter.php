<?php

namespace Cundd\Processor\Io\File\Writer;


use Cundd\Processor\Io\Type;
use Cundd\Processor\Io\WriterInterface;

class DefaultWriter implements WriterInterface
{
    /**
     * Writes the content to the given URI
     *
     * @param string       $uri
     * @param string|mixed $content
     * @return bool Returns if the resource was written
     */
    public function write(string $uri, $content): bool
    {
        Type::detectType($uri);

        $this->prepareTargetUri($uri);

        return 0 < file_put_contents($uri, (string)$content);
    }

    /**
     * @param string $uri
     */
    protected function prepareTargetUri(string $uri)
    {
        if (is_writable($uri)) {
            return;
        }

        $directory = dirname($uri);
        if (!file_exists($directory)) {
            if (!mkdir($directory, 770, true)) {
                throw new \RuntimeException(sprintf('Could not create directory "%s"', $directory));
            }
        }
    }
}
