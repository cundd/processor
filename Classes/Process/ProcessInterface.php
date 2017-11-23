<?php

namespace Cundd\Processor\Process;


interface ProcessInterface
{

    public function execute($input, $context = null);
}
