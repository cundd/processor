<?php
declare(strict_types=1);

namespace Cundd\Processor\Process\Collection;

use Cundd\Processor\Process\FunctionProcess;
use Cundd\Processor\Util;

class ReduceProcess extends FunctionProcess
{
    public function execute($input, $context = null)
    {
        return Util::collection(
            array_reduce(
                Util::collection($input)->getArrayCopy(),
                $this->callback,
                ...$this->appendArguments
            )
        );
    }
}
