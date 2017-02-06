<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 22.12.16
 * Time: 15:26
 */

namespace Cundd\Processor\Process;

class PrintProcess extends AbstractFunctionProcess
{
    public function execute($input, $context = null)
    {
        fwrite(STDOUT, (string)$input);
    }
}
