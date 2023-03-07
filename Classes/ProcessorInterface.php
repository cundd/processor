<?php
declare(strict_types=1);

namespace Cundd\Processor;

interface ProcessorInterface
{
    /**
     * Returns the last process' output
     *
     * @return mixed
     */
    public function getLastOutput();

    /**
     * Run all the stacked processes
     *
     * @param mixed $input
     * @param array ...$arguments
     * @return ProcessorInterface
     */
    public function run($input, ...$arguments): ProcessorInterface;

    /**
     * Build and stack a new process
     *
     * @param string $name
     * @param array  ...$constructorArguments
     * @return ProcessorChainInterface
     */
    public function process(string $name, ...$constructorArguments): ProcessorChainInterface;

    /**
     * Build a new process
     *
     * @param string $name
     * @param array  $constructorArguments
     * @return ProcessorChainInterface
     */
    public function createProcess(string $name, ...$constructorArguments): ProcessorChainInterface;
}
