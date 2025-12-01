<?php

declare(strict_types=1);

namespace MyVendor\MySitePackage\UserFunctions;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Attribute\AsAllowedCallable;
use TYPO3\CMS\Core\LinkHandling\LinkService;
use TYPO3\CMS\Frontend\Typolink\LinkResultInterface;

class TypoLinkUserFunc
{
    #[AsAllowedCallable]
    public function createUserFuncLink(
        LinkResultInterface $content,
        array $conf,
        ServerRequestInterface $request,
    ): LinkResultInterface {
        // First check what kind of link this is.
        // This example only operates on TYPE_PAGE for internal
        // links; the userFunc can of course also react to
        // types like TYPE_URL (external pages)
        if ($content->getType() === LinkService::TYPE_PAGE) {
            // Add (or replace) a custom "title" link attribute and
            // add "target=_blank" to it, and adjust the link text:

            return $content
                ->withTarget('_blank')
                ->withAttribute('title', 'Custom Title')
                ->withLinkText('A replaced link');
        }

        // If the condition does not match, return the unmodified
        // link.
        return $content;
    }
}
