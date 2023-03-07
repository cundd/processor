<?php
declare(strict_types=1);

namespace Cundd\Processor\Kernel;

interface KernelInterface
{
    public function execute(array $arguments): void;
}
