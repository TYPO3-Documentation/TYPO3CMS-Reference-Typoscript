<?php

declare(strict_types=1);

namespace MyVendor\SitePackage\UserFunctions;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Example of a method in a PHP class to be called from TypoScript
 */
final class ExampleListRecords
{
    /**
     * Reference to the parent (calling) cObject set from TypoScript
     */
    private ContentObjectRenderer $cObj;

    public function setContentObjectRenderer(ContentObjectRenderer $cObj): void
    {
        $this->cObj = $cObj;
    }

    /**
     * List the headers of the content elements on the page
     *
     * @param  string Empty string (no content to process)
     * @param  array  TypoScript configuration
     * @return string HTML output, showing content elements (in reverse order, if configured)
     */
    public function listContentRecordsOnPage(string $content, array $conf, ServerRequestInterface $request): string
    {
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tt_content');
        $result = $connection->select(
            ['header'],
            'tt_content',
            ['pid' => (int)$GLOBALS['TSFE']->id],
            [],
            ['sorting' => $conf['reverseOrder'] ? 'DESC' : 'ASC'],
        );
        $output = [];
        foreach ($result as $row) {
            $output[] = $row['header'];
        }
        return implode('<br />', $output);
    }
}
