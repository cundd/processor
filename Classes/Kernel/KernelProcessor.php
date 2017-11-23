<?php

namespace Cundd\Processor\Kernel;


use Cundd\Processor\Exception\KernelCompilationException;
use Cundd\Processor\Exception\KernelExecutionException;

class KernelProcessor
{
    /**
     * Prepares and executes the given kernel
     *
     * @param string       $kernel
     * @param \Traversable $data
     */
    public function executeKernel(string $kernel, \Traversable $data)
    {
        set_error_handler([$this, 'convertErrorToException']);

        $kernelInstance = $this->prepareKernel($kernel);
        try {
            $kernelInstance(['data' => $data]);
        } catch (\Error $error) {
            restore_error_handler();

            throw new KernelExecutionException(
                sprintf(
                    'Error during kernel execution: %s%s',
                    ($error->getCode() > 0 ? "#{$error->getCode()}: " : ''),
                    $error->getMessage()
                )
            );
        }
        restore_error_handler();
    }

    /**
     * @param int    $code
     * @param string $message
     * @param string $file
     * @param int    $line
     * @param array  $context
     * @throws \ErrorException
     * @internal
     */
    public function convertErrorToException($code, $message, $file, $line, array $context)
    {
        throw new \ErrorException($message, 0, $code, $file, $line);
    }

    /**
     * @param string $kernel
     * @return KernelInterface
     */
    protected function prepareKernel(string $kernel): KernelInterface
    {
        try {
            if (is_file($kernel)) {
                return new FileKernel($kernel);
            }

            return new StringKernel($kernel);
        } catch (\Error $error) {
            throw new KernelCompilationException(
                sprintf(
                    'Error during kernel compilation: %s%s',
                    ($error->getCode() > 0 ? "#{$error->getCode()}: " : ''),
                    $error->getMessage()
                )
            );
        }
    }
}