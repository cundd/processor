<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 22.12.16
 * Time: 15:38
 */

namespace Cundd\Processor\Process;

use Cundd\Processor\Argument\ArgumentUtil;
use Cundd\Processor\ProcessorInterface;

/**
 * Process that will invoke a function
 */
abstract class AbstractFunctionProcess extends AbstractProcess
{
    protected $currentInput;

    /**
     * Arguments to prepend when invoking the function
     *
     * @var array
     */
    protected $prependArguments;

    /**
     * Arguments to append when invoking the function
     *
     * @var array
     */
    protected $appendArguments;

    /**
     * FunctionProcess constructor
     *
     * @param ProcessorInterface $processor
     * @param array              $prependArguments
     * @param array              $appendArguments
     */
    public function __construct(
        ProcessorInterface $processor,
        array $prependArguments = [],
        array $appendArguments = []
    ) {
        parent::__construct($processor);

        $this->prependArguments = $prependArguments;
        $this->appendArguments = $appendArguments;
    }

    /**
     * @param int    $code
     * @param string $message
     * @param string $file
     * @param int    $line
     * @param array  $context
     * @throws \ErrorException
     */
    public function convertErrorToException($code, $message, $file, $line, array $context)
    {
        var_dump($this->currentInput);
        throw new \ErrorException($message, 0, $code, $file, $line);
    }

    /**
     * @param mixed $input
     * @param mixed $context
     * @return array
     */
    protected function getCallArguments($input, $context = null): array
    {
        $arguments = $this->getPreparedPrependArguments($input, $context);
        $arguments[] = $input;
        if (count($this->appendArguments) > 0) {
            $preparedAppendArguments = $this->getPreparedAppendArguments($input, $context);
            array_push($arguments, ...$preparedAppendArguments);

            return $arguments;
        }

        return $arguments;
    }

    /**
     * Pipe the prepend arguments through the argument pre-processing
     *
     * @param $input
     * @param $context
     * @return array
     */
    protected function getPreparedPrependArguments($input, $context): array
    {
        return ArgumentUtil::expandArguments($this->prependArguments, $input, $context);
    }

    /**
     * Pipe the append arguments through the argument pre-processing
     *
     * @param $input
     * @param $context
     * @return array
     */
    protected function getPreparedAppendArguments($input, $context): array
    {
        return ArgumentUtil::expandArguments($this->appendArguments, $input, $context);
    }
}
