<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 22.12.16
 * Time: 15:26
 */

namespace Cundd\Processor\Process\Collection;


use Cundd\Processor\Process\FunctionProcess;
use Cundd\Processor\Util;

class MapProcess extends FunctionProcess
{
    public function execute($input, $context = null)
    {
        return Util::collection($input)->map($this->callback);
    }
}
