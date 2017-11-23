<?php

namespace Cundd\Processor\Transformer;

/**
 * Transformer that will transform the input value to an array
 */
class ArrayTransformer
{
    public function execute($input)
    {
        if (is_array($input)) {
            return $input;
        } elseif ($input instanceof \Traversable) {
            return iterator_to_array($input);
        } elseif (null !== $input) {
            return [$input];
        }

        return [];
    }
}
