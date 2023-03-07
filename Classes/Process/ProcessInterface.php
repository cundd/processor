<?php
declare(strict_types=1);

namespace Cundd\Processor\Process;

interface ProcessInterface
{
    public function execute($input, $context = null);
}
