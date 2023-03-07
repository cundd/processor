<?php
declare(strict_types=1);

namespace Cundd\Processor\Process;

use Cundd\Processor\Util;

class ImplodeProcess extends AbstractFunctionProcess
{
    public function execute($input, $context = null): string
    {
        return Util::collection($input)->implode(...$this->prependArguments);
    }
}
