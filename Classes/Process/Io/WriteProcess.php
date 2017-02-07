<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 7.2.17
 * Time: 13:45
 */

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
