<?php
declare(strict_types=1);

namespace Cundd\Processor\Process;

use Cundd\Processor\ProcessorInterface;
use function var_dump;

/**
 * Process that will invoke a function
 */
class FunctionProcess extends AbstractFunctionProcess
{
    /**
     * @var string|callable|array
     */
    protected $callback;

    /**
     * FunctionProcess constructor
     *
     * @param ProcessorInterface    $processor
     * @param array|callable|string $callback
     * @param array                 $prependArguments
     * @param array                 $appendArguments
     */
    public function __construct(
        ProcessorInterface $processor,
        callable $callback,
        array $prependArguments = [],
        array $appendArguments = []
    ) {
        parent::__construct($processor, $prependArguments, $appendArguments);

        $this->callback = $callback;
    }

    public function execute($input, $context = null)
    {
        $this->currentInput = $input;
        set_error_handler([$this, 'convertErrorToException']);

        $output = call_user_func_array($this->callback, $this->getCallArguments($input, $context));

        restore_error_handler();

        return $output;
    }
}
