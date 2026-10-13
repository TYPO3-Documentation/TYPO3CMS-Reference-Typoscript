<?php

declare(strict_types=1);

namespace MyVendor\MyExtension\DataProcessing;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * Passes the categories of the current record to the template
 */
final readonly class CustomCategoryProcessor implements DataProcessorInterface
{
  public function __construct(
    private ConnectionPool $connectionPool,
  ) {}

  /**
   * @param array<string, mixed> $contentObjectConfiguration
   * @param array<string, mixed> $processorConfiguration
   * @param array<string, mixed> $processedData
   * @return array<string, mixed>
   */
  public function process(
    ContentObjectRenderer $cObj,
    array $contentObjectConfiguration,
    array $processorConfiguration,
    array $processedData,
  ): array {
    if (isset($processorConfiguration['if.']) && !$cObj->checkIf($processorConfiguration['if.'])) {
      return $processedData;
    }
    // The field "categories" holds only the number of categories, the
    // categories themselves are related through the MM table
    $queryBuilder = $this->connectionPool->getQueryBuilderForTable('sys_category');
    $categories = $queryBuilder
      ->select('category.*')
      ->from('sys_category', 'category')
      ->join(
        'category',
        'sys_category_record_mm',
        'mm',
        $queryBuilder->expr()->eq('mm.uid_local', $queryBuilder->quoteIdentifier('category.uid')),
      )
      ->where(
        $queryBuilder->expr()->eq('mm.tablenames', $queryBuilder->createNamedParameter($cObj->getCurrentTable())),
        $queryBuilder->expr()->eq('mm.fieldname', $queryBuilder->createNamedParameter('categories')),
        $queryBuilder->expr()->eq(
          'mm.uid_foreign',
          $queryBuilder->createNamedParameter((int)$cObj->data['uid'], Connection::PARAM_INT),
        ),
      )
      ->orderBy('mm.sorting_foreign')
      ->executeQuery()
      ->fetchAllAssociative();
    $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration, 'categories');
    $processedData[$targetVariableName] = $categories;
    return $processedData;
  }
}
