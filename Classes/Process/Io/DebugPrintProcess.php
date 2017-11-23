<?php

namespace Cundd\Processor\Process\Io;

class DebugPrintProcess extends PrintProcess
{
    public function execute($input, $context = null)
    {
        $fileHandle = fopen($this->uri, 'r+');
        if (!$fileHandle) {
            throw new \InvalidArgumentException(sprintf('Could not open file handle for "%s"', $this->uri));
        }

        // Capture var_dump()
        ob_start();
        var_dump($input);
        $output = ob_get_clean();

        fwrite($fileHandle, $output);
    }
}
