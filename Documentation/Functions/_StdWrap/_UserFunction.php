<?php

declare(strict_types=1);

namespace MyVendor\SitePackage\UserFunctions;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

final class YourClass
{
    /*
     * Reference to the parent (calling) cObject set from TypoScript
     */
    private ContentObjectRenderer $cObj;

    public function setContentObjectRenderer(
        ContentObjectRenderer $cObj,
    ): void {
        $this->cObj = $cObj;
    }

    /**
     * Custom method for data processing. Also demonstrates
     * how this gives us the ability to use methods in the
     * parent object.
     *
     * @param string $content holds the value to be processed.
     * @param array $conf TypoScript properties passed to this method.
     */
    public function reverseString(
        string $content,
        array $conf,
        ServerRequestInterface $request,
    ): string {
        $content = strrev($content);
        if (isset($conf['uppercase']) && $conf['uppercase'] === '1') {
            // Use the method caseshift() from ContentObjectRenderer
            $content = $this->cObj->caseshift($content, 'upper');
        }
        if (isset($conf['typolink'])) {
            // Use the method typoLink() from ContentObjectRenderer
            $content = $this->cObj
                ->typoLink($content, ['parameter' => $conf['typolink']]);
        }
        return $content;
    }
}
