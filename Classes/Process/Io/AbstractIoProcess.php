<?php
declare(strict_types=1);

namespace Cundd\Processor\Process\Io;

use Cundd\Processor\Process\AbstractProcess;
use Cundd\Processor\ProcessorInterface;

abstract class AbstractIoProcess extends AbstractProcess
{
    protected string $uri;

    public function __construct(ProcessorInterface $processor, string $uri)
    {
        parent::__construct($processor);
        $this->uri = $uri;
    }
}
