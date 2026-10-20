<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

// A static user TSconfig file, offered in the field "Include static
// TSconfig" of a backend user
ExtensionManagementUtility::registerUserTSConfigFile(
  'my_extension',
  'Configuration/TsConfig/User/editor.tsconfig',
  'Editor',
);
