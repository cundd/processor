<?php

namespace Cundd\Processor\Process\Collection;


use Cundd\Processor\Process\AbstractFunctionProcess;

abstract class AbstractCollectionProcess extends AbstractFunctionProcess
{
    public function execute($input, $context = null)
    {

    }

    /**
     * @param mixed $input
     * @param mixed $context
     * @return array
     */
    protected function getCallArguments($input, $context = null): array
    {
        return count($this->appendArguments) > 0
            ? $this->getPreparedAppendArguments($input, $context)
            : $this->getPreparedPrependArguments($input, $context);
    }
}
