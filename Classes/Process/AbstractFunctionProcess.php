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
    private $appendArguments;

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
     * @param int $code
     * @param string $message
     * @param string $file
     * @param int $line
     * @param array $context
     * @throws \ErrorException
     */
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
