<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 7.2.17
 * Time: 13:45
 */

namespace Cundd\Processor\Process\Io;


use Cundd\Processor\Process\AbstractProcess;
use Cundd\Processor\Process\ProcessInterface;
use Cundd\Processor\ProcessorInterface;

abstract class AbstractIoProcess extends AbstractProcess
{
    /**
     * @var string
     */
    protected $uri;

    /**
     * AbstractIoProcess constructor
     *
     * @param ProcessorInterface $processor
     * @param string             $uri
     */
    public function __construct(ProcessorInterface $processor, string $uri)
    {
        parent::__construct($processor);
        $this->uri = $uri;
    }
}
