<?php

namespace IqTool\Ci3LogViewer\Utils;

class GenerateCacheKey
{
    public static function for(mixed $object, string $key = ''): string
    {
        $class = get_class($object);
        $identifier = $object->identifier ?? md5(serialize($object));

        return 'log-viewer:' . Utils::shortMd5($class) . ':' . $identifier . ':' . $key;
    }
}
