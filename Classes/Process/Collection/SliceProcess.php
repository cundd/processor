<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 22.12.16
 * Time: 15:26
 */

namespace Cundd\Processor\Process\Collection;


use Cundd\Processor\Util;

class SliceProcess extends AbstractCollectionProcess
{
    public function execute($input, $context = null)
    {
        return array_slice(Util::collection($input)->getArrayCopy(), ...$this->getCallArguments($input, $context));
    }
}
