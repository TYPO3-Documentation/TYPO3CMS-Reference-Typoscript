<?php

declare(strict_types=1);

namespace MyVendor\MySitePackage\UserFunctions;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\LinkHandling\LinkService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\Typolink\LinkResult;
use TYPO3\CMS\Frontend\Typolink\LinkResultInterface;

class TypoLinkUserFunc
{
    public function createUserFuncLink(
        LinkResultInterface $content,
        array $conf,
        ServerRequestInterface $request
    ): LinkResultInterface {

        // First check what kind of link this is.
        // This example only operates on TYPE_PAGE for internal
        // links; the userFunc can of course also react to
        // types like TYPE_URL (external pages)
        if ($content->getType() === LinkService::TYPE_PAGE) {
            $cObj = $this->getContentObjectRenderer($request);

            // Check if typolink.userFunc additional data is set
            // and act on it
            if ($conf['eventUid.']['data'] ?? null) {
                $url = $content->getAttribute('href')
                       . '/event/' . (int)$conf['eventUid.']['data'];
                // Here you could do database lookups for example
                // to add for example extbase routing URIs and retrieve
                // fields.
                $linkText = 'Event Title #18';
            } else {
                // Use currently defined URL
                $url = $content->getUrl();
                // Example how to utilize the cObj and it's wrapping so
                // that `<a href=...><strong>(TITLE!)</strong></a>`
                // would be returned.
                $linkText = $cObj->stdWrap_dataWrap('<strong>{FIELD:title}</strong');
            }

            return $content
                ->withTarget('_blank')
                #->withUrl($url)
                ->withAttribute('title', 'Custom: ' . $cObj->data['title'])
                ->withLinkText($linkText);
        } else if ($conf['freshExternalLink'] ?? false) {
            // Depending on conditions, you could also return a completely new object
            // for an external link:
            return (new LinkResult(LinkService::TYPE_URL, 'https://example.com'))
                    ->withLinkText('I am a link');
        } else if ($conf['freshInternalLink'] ?? false) {
            // ... or an internal link (UID in $conf['freshInternalPageUid']):
            $cObj = $this->getContentObjectRenderer($request);
            $frontendUrl = $cObj->typoLink_URL(['parameter' => $conf['freshInternalPageUid'] ?? 1]);
            return (new LinkResult(LinkService::TYPE_PAGE, $frontendUrl))
                ->withLinkText('I am a link');
        }

        // If the condition does not match, return the unmodified
        // link.
        return $content;
    }

    protected function getContentObjectRenderer(ServerRequestInterface $request): ContentObjectRenderer
    {
        return $request->getAttribute('currentContentObject');
    }
}
