<?php
declare(strict_types=1);

namespace Cundd\Processor\Kernel;

use Cundd\Processor\Processor;
use Cundd\Processor\ProcessorInterface;

class FileKernel implements KernelInterface
{
    private string $file;

    /**
     * Kernel constructor.
     *
     * @param string $file
     */
    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function execute(array $arguments): void
    {
        extract($arguments);

         include $this->file;
    }
}
