<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 22.12.16
 * Time: 15:26
 */

namespace Cundd\Processor\Process\Collection;


use Cundd\Processor\Process\FunctionProcess;
use Cundd\Processor\Util;

class FlatMapProcess extends FunctionProcess
{
    public function execute($input, $context = null)
    {
        $callback = $this->callback;
        $result = [];
        foreach (Util::collection($input) as $key => $value) {
            $currentTempResult = $callback($value, $key);
            $result = array_merge($result, $this->prepareCurrentResult($currentTempResult));
        }

        return Util::collection($result);
    }

    /**
     * @param $currentTempResult
     * @return array
     */
    private function prepareCurrentResult($currentTempResult): array
    {
        if (is_array($currentTempResult)) {
            return array_values($currentTempResult);
        } elseif ($currentTempResult instanceof \Traversable) {
            return $this->prepareCurrentResult(iterator_to_array($currentTempResult));
        }

        return [$currentTempResult];
    }
}
