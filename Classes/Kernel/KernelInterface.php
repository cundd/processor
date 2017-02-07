<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 7.2.17
 * Time: 11:33
 */

namespace Cundd\Processor\Kernel;


interface KernelInterface
{
    function __invoke(array $arguments);
}
