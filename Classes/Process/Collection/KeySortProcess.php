<?php

namespace Cundd\Processor\Process\Collection;


use Cundd\Processor\Process\FunctionProcess;
use Cundd\Processor\Util;

class KeySortProcess extends FunctionProcess
{
    public function execute($input, $context = null)
    {
        $inputCollection = Util::collection($input)->getArrayCopy();
        uksort($inputCollection, $this->callback);

        return $inputCollection;
    }
}
