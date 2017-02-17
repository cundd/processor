<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 22.12.16
 * Time: 15:26
 */

namespace Cundd\Processor\Process\Io;


use Cundd\Processor\ProcessorInterface;

class PrintProcess extends AbstractIoProcess
{
    /**
     * AbstractIoProcess constructor.
     *
     * @param ProcessorInterface $processor
     * @param string             $uri
     */
    public function __construct(ProcessorInterface $processor, $uri = 'php://output')
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
