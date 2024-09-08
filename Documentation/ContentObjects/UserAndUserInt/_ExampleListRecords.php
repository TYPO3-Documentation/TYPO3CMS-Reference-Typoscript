<?php

declare(strict_types=1);

namespace MyVendor\SitePackage\UserFunctions;

use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Example of a method in a PHP class to be called from TypoScript
 *
 * The class is defined as public as we use dependency injection in
 * this example. If you do not need dependency injection, the
 * "Autoconfigure" attribute should be omitted!
 */
#[Autoconfigure(public: true)]
final class ExampleListRecords
{
    public function __construct(
        private readonly ConnectionPool $connectionPool,
    ) {}

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
     * @param string Empty string (no content to process)
     * @param array TypoScript configuration
     * @param ServerRequestInterface The current PSR-7 request object
     * @return string HTML output, showing content elements (in reverse order, if configured)
     */
    public function listContentRecordsOnPage(string $content, array $conf, ServerRequestInterface $request): string
    {
        $connection = $this->connectionPool->getConnectionForTable('tt_content');
        $result = $connection->select(
            ['header'],
            'tt_content',
            // The request attribute 'frontend.page.information' has been introduced
            // with TYPO3 v13. For compatibility with older TYPO3 versions use the
            // version switch on the top of the page.
            ['pid' => $request->getAttribute('frontend.page.information')->getId()],
            [],
            ['sorting' => $conf['reverseOrder'] ? 'DESC' : 'ASC'],
        );
        $output = [];
        foreach ($result as $row) {
            $output[] = $row['header'];
        }
        return implode('<br>', $output);
    }
}
