<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 22.12.16
 * Time: 15:38
 */

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
