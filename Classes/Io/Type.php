<?php

namespace Cundd\Processor\Io;


abstract class Type
{
    /**
     * IO affects a local resource
     */
    const LOCAL_READER = 'local';

    /**
     * IO affects a remote resource
     */
    const REMOTE_READER = 'remote';


    /**
     * Detect the type for the given URI
     *
     * @param string $uri
     * @return string
     */
    public static function detectType(string $uri): string
    {
        if (strpos($uri, '//') !== false && substr($uri, 0, 8) !== 'file:///') {
            throw new \LogicException('Remote readers are not yet supported');
        }

        return Type::LOCAL_READER;
    }
}
