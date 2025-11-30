<?php

declare(strict_types=1);

namespace MyVendor\SitePackage\UserFunctions;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Attribute\AsAllowedCallable;

final class ExampleTime
{
    /**
     * Output the current time in red letters
     *
     * @param string Empty string (no content to process)
     * @param array TypoScript configuration
     * @param ServerRequestInterface $request
     * @return string HTML output, showing the current server time.
     */
    #[AsAllowedCallable]
    public function printTime(string $content, array $conf, ServerRequestInterface $request): string
    {
        return '<p style="color: red;">Dynamic time: ' . date('H:i:s') . '</p><br />';
    }
}
