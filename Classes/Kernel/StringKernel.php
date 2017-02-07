<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 7.2.17
 * Time: 11:33
 */

namespace Cundd\Processor\Kernel;


use Cundd\Processor\ProcessorInterface;

class StringKernel implements KernelInterface
{
    private $script = '';

    /**
     * Kernel constructor.
     *
     * @param string $script
     */
    public function __construct(string $script)
    {
        $this->script = $script;
    }

    function __invoke(array $arguments)
    {
        extract($arguments);
        return eval($this->script);
    }
}
