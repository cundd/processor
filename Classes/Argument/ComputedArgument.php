<?php

namespace Cundd\Processor\Argument;


use Cundd\Processor\Process\ProcessInterface;

class ComputedArgument implements ProcessInterface
{
    private $callback;

    /**
     * Argument constructor.
     *
     * @param $callback
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function execute($input, $context = null)
    {
        return call_user_func($this->callback, $input);
    }
}
