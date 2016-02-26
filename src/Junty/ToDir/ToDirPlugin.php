<?php
namespace Junty\TymylToDir;

use Junty\Plugin\PluginInterface;
use Junty\Stream\Stream;

class ToDirPlugin implements PluginInterface
{
    private $dest;

    public function __construct(strgin $dest)
    {
        $this->dest = $dest;
    }

    public function getName() : string
    {
        return 'to_dir';
    }

    public function getCallback() : callable
    {
        $that = $this;

        return function (array $streams) use ($that) {
            $dest = $that->dest;

            if (!is_dir($dest)) {
                mkdir($dest);
            }

            $streams = is_array($streams) ? $streams : [$streams];

            foreach ($streams as $stream) {
                $newStream = new Stream(
                    fopen(
                        $dest . '/'. $that->getFileName(
                            $stream->getMetaData('uri')
                        ),
                        'w+'
                    )
                );
                $newStream->write($stream->getContents());
            }
        };
    }

    private function getFileName($name) : string
    {
        $parts = explode('/', $name);
        return end($parts);
    }
}