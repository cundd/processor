<?php
declare(strict_types=1);

namespace Cundd\Processor\Process\Collection;

use Cundd\Processor\Process\FunctionProcess;
use Cundd\Processor\Util;

class FilterProcess extends FunctionProcess
{
    public function execute($input, $context = null)
    {
        return Util::collection($input)->filter($this->callback);
    }
}
