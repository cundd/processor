<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 22.12.16
 * Time: 15:38
 */

namespace Cundd\Processor\Process;

use Cundd\Processor\ProcessorInterface;
use Cundd\Processor\Transformer\ArrayTransformer;


/**
 * Process that will transform the input value
 */
class TransformProcess extends AbstractProcess
{
    /**
     * @var string
     */
    protected $targetType = '';

    /**
     * TransformProcess constructor.
     *
     * @param ProcessorInterface $processor
     * @param string             $targetType
     */
    public function __construct(ProcessorInterface $processor, string $targetType)
    {
        parent::__construct($processor);
        $this->targetType = $targetType;
    }


    public function execute($input, $context = null)
    {
        if ($this->targetType === 'array') {
            return (new ArrayTransformer())->execute($input);
        }

        throw new \InvalidArgumentException(sprintf('Transformer for "%s" not implemented', $this->targetType));
    }
}
