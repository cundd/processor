<?php

namespace Cundd\Processor\Kernel;


class StringKernel implements KernelInterface
{
    private $script = '';

    /**
     * Kernel constructor.
     *
     * @param string $script
     */
    public function __construct(string $script)
    {
        $this->script = $script;
    }

    function __invoke(array $arguments)
    {
        extract($arguments);

        return eval($this->script);
    }
}
