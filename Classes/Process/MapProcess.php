<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 22.12.16
 * Time: 15:26
 */

namespace Cundd\Processor\Process;


use Cundd\Processor\Util;

class MapProcess extends FunctionProcess
{

    public function execute($input, $context = null)
    {
//        var_dump(is_array($input) ? get_class(reset($input)) : get_class($input));

        return Util::collection($input)->map($this->callback);
    }

    private function assertCallback($input, $index)
    {
        if (!isset($input[$index])) {
            var_dump($input);
            throw new \OutOfRangeException("Index $index out of range");
        }
        if (!is_callable($input[$index])) {
            throw new \InvalidArgumentException("Element at index $index is not callable");
        }
    }


}