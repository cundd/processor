<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 22.12.16
 * Time: 15:26
 */

namespace Cundd\Processor\Process;


use Cundd\Processor\Util;

class ImplodeProcess extends AbstractFunctionProcess
{
    public function execute($input, $context = null)
    {
        return Util::collection($input)->implode(...$this->prependArguments);
    }
}
