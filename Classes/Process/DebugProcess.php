<?php
declare(strict_types=1);

namespace Cundd\Processor\Process;

use Cundd\Processor\Util;
use function var_dump;

class DebugProcess extends AbstractProcess
{
    public function execute($input, $context = null)
    {
        Util::collection($input)->map(fn($x) => var_dump($x));

        return $input;
    }
}
