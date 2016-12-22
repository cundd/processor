<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 22.12.16
 * Time: 15:38
 */

namespace Cundd\Processor\Process;

use Cundd\Processor\ProcessorInterface;
use SebastianBergmann\CodeCoverage\Report\PHP;


/**
 * Process that will invoke a function
 */
class FunctionProcess extends AbstractProcess
{
    /**
     * @var string|callable|array
     */
    protected $callback;

    protected $currentInput;
    /**
     * @var array
     */
    private $prependArguments;
    /**
     * @var array
     */
    private $appendArguments;

    /**
     * FunctionProcess constructor
     *
     * @param ProcessorInterface    $processor
     * @param array|callable|string $callback
     * @param array                 $prependArguments
     * @param array                 $appendArguments
     */
    public function __construct(ProcessorInterface $processor, callable $callback, array $prependArguments = [], array $appendArguments = [])
    {
        parent::__construct($processor);

        $this->callback = $callback;
        $this->prependArguments = $prependArguments;
        $this->appendArguments = $appendArguments;
    }


    public function execute($input, $context = null)
    {
        $this->currentInput = $input;
        set_error_handler([$this, 'convertErrorToException']);

        $output = call_user_func_array($this->callback, $this->getCallArguments($input));

        restore_error_handler();

        return $output;
    }

    public function convertErrorToException($code, $message, $file, $line, array $context)
    {
        var_dump($this->currentInput);
        throw new \ErrorException($message, 0, $code, $file, $line);
    }

    /**
     * @param $input
     * @return array
     */
    protected function getCallArguments($input): array
    {
        $arguments = $this->prependArguments;
        $arguments[] = $input;
        if (count($this->appendArguments) > 0) {
            array_push($arguments, ...$this->appendArguments);

            return $arguments;
        }

        return $arguments;
    }
}
