<?php

namespace Cundd\Processor\Process\Io;


use Cundd\Processor\Io\File\Writer\DefaultWriter;

class WriteProcess extends AbstractIoProcess
{
    public function execute($input, $context = null)
    {
        $writer = new DefaultWriter();
        $writer->write($this->uri, $input);

        return $input;
    }
}
