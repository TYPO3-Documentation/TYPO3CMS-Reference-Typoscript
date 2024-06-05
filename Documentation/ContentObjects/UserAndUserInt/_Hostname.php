<?php

declare(strict_types=1);

namespace Vendor\SitePackage\UserFunctions;

final class Hostname
{
    /**
     * Return standard host name for the local machine
     *
     * @param  string Empty string (no content to process)
     * @param  array  TypoScript configuration
     * @return string HTML result
     */
    public function getHostname(string $content, array $conf): string
    {
        return gethostname() ?: '';
    }
}
