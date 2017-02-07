<?php
/**
 * Created by PhpStorm.
 * User: cod
 * Date: 7.2.17
 * Time: 11:33
 */

namespace Cundd\Processor\Kernel;


class FileKernel implements KernelInterface
{
    private $file = '';

    /**
     * Kernel constructor.
     *
     * @param string $file
     */
    public function __construct(string $file)
    {
        $this->file = $file;
    }

    function __invoke(array $arguments)
    {
        extract($arguments);

        return include $this->file;
    }
}
