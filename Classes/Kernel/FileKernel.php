<?php

namespace Cundd\Processor\Kernel;


class FileKernel implements KernelInterface
{
    private $file = '';

    /**
     * Kernel constructor.
     *
     * @param string $file
     */
    public function __construct(string $file)
    {
        $this->file = $file;
    }

    function __invoke(array $arguments)
    {
        extract($arguments);

        return include $this->file;
    }
}
