<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

// The character that separates the values of the comma-separated value
// example in its field "bodytext"
ExtensionManagementUtility::addTCAcolumns('tt_content', [
  'tx_myextension_separator' => [
    'label' => 'Separator',
    'config' => [
      'type' => 'input',
      'size' => 1,
      'max' => 1,
      'default' => ',',
    ],
  ],
]);
