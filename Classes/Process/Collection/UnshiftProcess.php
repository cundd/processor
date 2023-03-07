<?php
declare(strict_types=1);

namespace Cundd\Processor\Process\Collection;

use Cundd\Processor\Util;

class UnshiftProcess extends AbstractCollectionProcess
{
    public function execute($input, $context = null)
    {
        $inputCollection = Util::collection($input)->getArrayCopy();
        array_unshift($inputCollection, ...$this->getCallArguments($input, $context));

        return $inputCollection;
    }
}
