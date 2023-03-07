<?php
declare(strict_types=1);

namespace Cundd\Processor\Process;

use Cundd\Processor\ProcessorChainInterface;
use Cundd\Processor\ProcessorInterface;

abstract class AbstractProcess implements ProcessorChainInterface
{
    protected ProcessorInterface $processor;

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
        return $this->execute($input, $context);
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
     * @return ProcessorInterface
     */
    public function run($input, ...$arguments): ProcessorInterface
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
