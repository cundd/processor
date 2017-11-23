<?php

namespace Cundd\Processor\Process\Collection;


use Cundd\Processor\Util;

class PushProcess extends AbstractCollectionProcess
{
    public function execute($input, $context = null)
    {
        $inputCollection = Util::collection($input)->getArrayCopy();
        array_push($inputCollection, ...$this->getCallArguments($input, $context));

        return $inputCollection;
    }
}
