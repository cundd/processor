<?php

namespace Cundd\Processor\Kernel;


interface KernelInterface
{
    function __invoke(array $arguments);
}
