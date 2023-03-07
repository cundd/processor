<?php
declare(strict_types=1);

namespace Cundd\Processor\Process\Io;

use Cundd\Processor\ProcessorInterface;

class PrintProcess extends AbstractIoProcess
{
    public function __construct(ProcessorInterface $processor, string $uri = 'php://output')
    {
        parent::__construct($processor, $uri);
    }

    public function execute($input, $context = null)
    {
        $fileHandle = fopen($this->uri, 'r+');
        if (!$fileHandle) {
            throw new \InvalidArgumentException(sprintf('Could not open file handle for "%s"', $this->uri));
        }
        fwrite($fileHandle, (string)$input);
    }
}
