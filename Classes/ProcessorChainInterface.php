<?php
declare(strict_types=1);

namespace Cundd\Processor;

use Cundd\Processor\Process\ProcessInterface;

interface ProcessorChainInterface extends ProcessInterface, ProcessorInterface
{
}
