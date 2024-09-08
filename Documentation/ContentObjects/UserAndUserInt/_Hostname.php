<?php

declare(strict_types=1);

namespace MyVendor\SitePackage\UserFunctions;

use Psr\Http\Message\ServerRequestInterface;

final class Hostname
{
    /**
     * Return standard host name for the local machine
     *
     * @param  string Empty string (no content to process)
     * @param  array  TypoScript configuration
     * @param ServerRequestInterface $request The current PSR-7 request object
     * @return string HTML result
     */
    public function getHostname(string $content, array $conf, ServerRequestInterface $request): string
    {
        return gethostname() ?: '';
    }
}
