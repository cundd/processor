<?php

namespace Cundd\Processor\Process;


use Cundd\Processor\Util;

class ImplodeProcess extends AbstractFunctionProcess
{
    public function execute($input, $context = null)
    {
        return Util::collection($input)->implode(...$this->prependArguments);
    }
}
