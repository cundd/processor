<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 7.2.17
 * Time: 11:55
 */

namespace Cundd\Processor\Argument;


use Cundd\Processor\Process\AbstractFunctionProcess;
use Cundd\Processor\Process\ProcessInterface;

class ArgumentUtil
{
    /**
     * If the argument is an instance of Argument it will be expanded, otherwise the original argument is returned
     *
     * @param mixed $argument
     * @param mixed $input
     * @param mixed $context
     * @return mixed
     */
    public static function expandArgument($argument, $input, $context = null)
    {
        if ($argument instanceof ComputedArgument) {
            return $argument->execute($input, $context);
        }

        return $argument;
    }

    /**
     * Loops over the arguments and transforms them if necessary
     *
     * @see expandArgument
     * @param array $arguments
     * @param mixed $input
     * @param mixed $context
     * @return array
     */
    public static function expandArguments(array $arguments, $input, $context = null): array
    {
        if (count($arguments) === 0) {
            return [];
        }
        $preparedArguments = [];
        foreach ($arguments as $key => $argument) {
            $preparedArguments[$key] = static::expandArgument($argument, $input, $context);
        }

        return $preparedArguments;
    }
}
