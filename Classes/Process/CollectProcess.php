<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 22.12.16
 * Time: 15:38
 */

namespace Cundd\Processor\Process;

use Cundd\Processor\ProcessorInterface;
use Iresults\Core\Helpers\ObjectHelper;


/**
 * Process that will collect values
 */
class CollectProcess extends AbstractProcess
{
    /**
     * @var string|callable|array
     */
    private $keyPath;

    /**
     * CollectProcess constructor.
     *
     * @param ProcessorInterface $processor
     * @param string             $keyPath
     */
    public function __construct(ProcessorInterface $processor, string $keyPath)
    {
        parent::__construct($processor);
        $this->keyPath = $keyPath;
    }

    public function execute($input, $context = null)
    {
        return ObjectHelper::getObjectForKeyPathOfObject($this->keyPath, $input);
    }
}
