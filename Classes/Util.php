<?php
declare(strict_types=1);

namespace Cundd\Processor;

abstract class Util
{
    /**
     * @param $input
     * @return Collection
     */
    public static function collection($input): Collection
    {
        if (is_array($input)) {
            return new Collection($input);
        }
        if ($input instanceof \Traversable) {
            return static::collection(iterator_to_array($input));
        }

        return static::collection([$input]);
    }
}
