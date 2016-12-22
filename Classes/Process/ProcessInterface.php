<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 22.12.16
 * Time: 15:09
 */

namespace Cundd\Processor\Process;


interface ProcessInterface
{

    public function execute($input, $context = null);
}
