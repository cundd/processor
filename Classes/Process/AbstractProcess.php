<?php

namespace Cundd\Processor\Process;


use Cundd\Processor\Processor;
use Cundd\Processor\ProcessorChainInterface;
use Cundd\Processor\ProcessorInterface;

abstract class AbstractProcess implements ProcessorChainInterface
{
    /**
     * @var ProcessorInterface
     */
    protected $processor;

    /**
     * AbstractProcess constructor.
     *
     * @param ProcessorInterface $processor
     */
    public function __construct(ProcessorInterface $processor)
    {
        $this->processor = $processor;
    }

    /**
     * @param $input
     * @param $context
     * @return mixed
     */
    function __invoke($input, $context = null)
    {
        return $this->execute($input, $context = null);
    }

    /**
     * Returns the last process' output
     *
     * @return mixed
     */
    public function getLastOutput()
    {
        return $this->processor->getLastOutput();
    }

    /**
     * Run all the stacked processes
     *
     * @param mixed $input
     * @param array ...$arguments
     * @return Processor
     */
    public function run($input, ...$arguments): Processor
    {
        return $this->processor->run($input, ...$arguments);
    }

    /**
     * Build and stack a new process
     *
     * @param string $name
     * @param array  ...$constructorArguments
     * @return ProcessorChainInterface
     */
    public function process(string $name, ...$constructorArguments): ProcessorChainInterface
    {
        return $this->processor->process($name, ...$constructorArguments);
    }

    /**
     * Build a new process
     *
     * @param string $name
     * @param array  $constructorArguments
     * @return ProcessorChainInterface
     */
    public function createProcess(string $name, ...$constructorArguments): ProcessorChainInterface
    {
        return $this->processor->createProcess($name, ...$constructorArguments);
    }
}
