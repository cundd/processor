<?php

namespace Cundd\Processor\Process\Collection;


use Cundd\Processor\Util;

class SliceProcess extends AbstractCollectionProcess
{
    public function execute($input, $context = null)
    {
        return array_slice(Util::collection($input)->getArrayCopy(), ...$this->getCallArguments($input, $context));
    }
}
