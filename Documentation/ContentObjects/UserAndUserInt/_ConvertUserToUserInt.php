<?php

declare(strict_types=1);

namespace MyVendor\MyExtension\UserFunc;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Attribute\AsAllowedCallable;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

final class PluginRenderer
{
    /**
     * @param string $content Empty string from the TypoScript pipeline
     * @param array $conf TypoScript configuration array passed to this object
     * @param ServerRequestInterface $request The PSR-7 server request object
     */
    #[AsAllowedCallable]
    public function renderPlugin(string $content, array $conf, ServerRequestInterface $request): string
    {
        /** @var ContentObjectRenderer $cObj */
        $cObj = $request->getAttribute('currentContentObject');
        $showLiveSearch = (bool)($conf['settings.']['showLiveSearch'] ?? false);

        if (!$showLiveSearch) {
            return '<div>Standard list view (cached)</div>';
        }

        // Live search results are personal and must never be cached: promote this
        // cObject to USER_INT, unless this call is already the non-cached re-render.
        if ($cObj->getUserObjectType() === ContentObjectRenderer::OBJECTTYPE_USER) {
            $cObj->convertToUserIntObject();
        }

        return '<div>Live search result</div>';
    }
}
