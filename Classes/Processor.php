<?php
declare(strict_types=1);

namespace Cundd\Processor;

use Cundd\Processor\Process\FunctionProcess;
use Cundd\Processor\Process\ProcessInterface;
use InvalidArgumentException;
use function ucfirst;

class Processor implements ProcessorInterface
{
    /**
     * @var array
     */
    private array $outputStack = [];

    /**
     * @var ProcessInterface[]
     */
    private array $processStack = [];

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
     * @return ProcessorInterface
     */
    public function run($input, ...$arguments): ProcessorInterface
    {
        $currentWorkingData = $input;
        foreach ($this->processStack as $process) {
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
     * Creates a new Process and attaches it to the chain
     *
     * @param string $name
     * @param mixed  ...$constructorArguments
     * @return ProcessorChainInterface
     */
    public function process(string $name, ...$constructorArguments): ProcessorChainInterface
    {
        return $this->attach($this->createProcess($name, ...$constructorArguments));
    }

    /**
     * Attaches a Process to the chain
     *
     * @param ProcessorChainInterface $process
     * @return ProcessorChainInterface
     */
    public function attach(ProcessorChainInterface $process): ProcessorChainInterface
    {
        // TODO: Add this to the interface
        $this->processStack[] = $process;

        return $process;
    }

    /**
     * Creates a new Process
     *
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
            $className = 'Cundd\\Processor\\Process\\' . $this->prepareClassName($name) . 'Process';
        }
        if (class_exists($className)) {
            return new $className($this, ...$constructorArguments);
        }

        if (function_exists($name)) {
            return new FunctionProcess($this, $name, ...$constructorArguments);
        }

        throw new InvalidArgumentException(sprintf('No processor found for "%s"', $name));
    }

    /**
     * @param string $name
     * @return string
     */
    protected function prepareClassName(string $name): string
    {
        if (strpos($name, '.') === false) {
            return ucfirst($name);
        }

        if (strtolower(substr($name, 0, 5)) === 'array') {
            return $this->prepareClassName('collection' . substr($name, 5));
        }

        return implode('\\', array_map('ucfirst', explode('.', $name)));
    }
}
