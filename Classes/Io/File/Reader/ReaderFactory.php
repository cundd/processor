<?php
declare(strict_types=1);

namespace Cundd\Processor\Io\File\Reader;

use Cundd\Processor\Io\ReaderInterface;
use Cundd\Processor\Io\Type;
use LogicException;

class ReaderFactory
{
    /**
     * Detects the Reader implementation for the given URI
     *
     * @param string $uri
     * @return ReaderInterface
     */
    public static function getReaderForUri(string $uri): ReaderInterface
    {
        if (!trim($uri)) {
            throw new \InvalidArgumentException('Argument URI must not be empty');
        }
        if (!file_exists($uri)) {
            throw new \InvalidArgumentException(sprintf('File "%s" does not seem to exist', $uri));
        }
        if (!is_readable($uri)) {
            throw new \InvalidArgumentException(sprintf('File "%s" is not readable', $uri));
        }
        $instance = new static();

        return $instance->detectReaderForUri($uri);
    }

    /**
     * @param string $uri
     * @return string
     */
    private function detectMimeType(string $uri): string
    {
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($fileInfo, $uri);
        finfo_close($fileInfo);

        return (string)$mimeType;
    }

    /**
     * @param string $type
     * @return ReaderInterface
     */
    private function getReaderForMimeType(string $type): ReaderInterface
    {
        throw new LogicException(sprintf('No reader for mime type "%s" found', $type));
    }

    /**
     * @param string $uri
     * @return string
     */
    private function getSuffixForUri(string $uri): string
    {
        return substr(strrchr($uri, '.'), 1);
    }

    /**
     * @param string $suffix
     * @return ReaderInterface
     */
    private function getReaderForSuffix(string $suffix): ReaderInterface
    {
        $readerClassName = sprintf('Cundd\\Processor\\Io\\File\\Reader\\%sReader', ucfirst(strtolower($suffix)));
        if (!class_exists($readerClassName)) {
            throw new LogicException(sprintf('Reader "%s" not found', $readerClassName));
        }

        return new $readerClassName;
    }

    /**
     * @param string $uri
     * @return ReaderInterface
     */
    private function detectReaderForUri(string $uri): ReaderInterface
    {
        Type::detectType($uri);
        $mimeType = $this->detectMimeType($uri);

        if ($mimeType === 'text/plain') { // 'text/plain' is too general
            return $this->getReaderForSuffix($this->getSuffixForUri($uri));
        }

        return $this->getReaderForMimeType($mimeType);
    }
}
