<?php

namespace MyVendor\MyExtension\SomeNamespace;

use Psr\Http\Message\ServerRequestInterface;

class SomeClass
{
    /**
     * @param string $content Empty string (no content to process)
     * @param array $conf TypoScript configuration
     */
    public function someFunction(string $content, array $conf, ServerRequestInterface $request): string
    {
        $changedContent = $content;
        // Do something
        return $changedContent;
    }
}
