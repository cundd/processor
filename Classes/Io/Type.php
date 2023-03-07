<?php
declare(strict_types=1);

namespace Cundd\Processor\Io;

use LogicException;

abstract class Type
{
    /**
     * IO affects a local resource
     */
    public const LOCAL_READER = 'local';

    /**
     * IO affects a remote resource
     */
    public const REMOTE_READER = 'remote';

    /**
     * Detect the type for the given URI
     *
     * @param string $uri
     * @return string
     */
    public static function detectType(string $uri): string
    {
        if (strpos($uri, '//') !== false && substr($uri, 0, 8) !== 'file:///') {
            throw new LogicException('Remote readers are not yet supported');
        }

        return Type::LOCAL_READER;
    }
}
