<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 22.12.16
 * Time: 15:09
 */

namespace Cundd\Processor;


use Cundd\Processor\Process\FunctionProcess;
use Cundd\Processor\Process\ProcessInterface;

class Processor implements ProcessorInterface
{
    /**
     * @var array
     */
    private $outputStack = [];

    /**
     * @var ProcessInterface[]
     */
    private $processStack = [];

    /**
     * @return mixed
     */
    public function getLastOutput()
    {
        return end($this->outputStack);
    }

    /**
     * @param mixed $input
     * @param array ...$arguments
     * @return Processor
     */
    public function run($input, ...$arguments): Processor
    {
        $currentWorkingData = $input;
        foreach ($this->processStack as $key => $process) {
            $currentWorkingData = $process->execute($currentWorkingData, $arguments);

            $this->outputStack[] = $currentWorkingData;
        }

        return $this;
    }

    function __call($name, $arguments)
    {
        return call_user_func_array([$this, 'process'], func_get_args());
    }

    /**
     * @param string $name
     * @param array  ...$constructorArguments
     * @return ProcessorChainInterface
     */
    public function process(string $name, ...$constructorArguments): ProcessorChainInterface
    {
        $process = $this->createProcess($name, ...$constructorArguments);
        $this->processStack[] = $process;

        return $process;
    }

    /**
     * @param string $name
     * @param array  $constructorArguments
     * @return ProcessorChainInterface
     */
    public function createProcess(string $name, ...$constructorArguments): ProcessorChainInterface
    {
        $className = $name;
        if (!class_exists($className)) {
            $className = ucfirst($name);
        }
        if (!class_exists($className)) {
            $className = 'Cundd\\Processor\\Process\\' . ucfirst($name) . 'Process';
        }
        if (class_exists($className)) {
            return new $className($this, ...$constructorArguments);
        }

        if (function_exists($name)) {
            return new FunctionProcess($this, $name, ...$constructorArguments);
        }
        throw new \InvalidArgumentException(sprintf('No processor found for "%s"', $name));
    }
}
