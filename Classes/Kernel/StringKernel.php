<?php
declare(strict_types=1);

namespace Cundd\Processor\Kernel;

class StringKernel implements KernelInterface
{
    private string $script;

    /**
     * Kernel constructor.
     *
     * @param string $script
     */
    public function __construct(string $script)
    {
        $this->script = $script;
    }

    public function execute(array $arguments): void
    {
        extract($arguments);

        eval($this->script);
    }
}
