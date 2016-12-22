<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 22.12.16
 * Time: 17:10
 */
namespace Cundd\Processor;

use Cundd\Processor\Process\ProcessInterface;

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
     * @return Processor
     */
    public function run($input, ...$arguments): Processor;

    /**
     * Build and stack a new process
     *
     * @param string $name
     * @param array  ...$constructorArguments
     * @return ProcessInterface
     */
    public function process(string $name, ...$constructorArguments): ProcessInterface;

    /**
     * Build a new process
     *
     * @param string $name
     * @param array  $constructorArguments
     * @return ProcessInterface
     */
    public function createProcess(string $name, ...$constructorArguments): ProcessInterface;
}
