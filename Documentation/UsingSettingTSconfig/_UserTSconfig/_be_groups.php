<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

ExtensionManagementUtility::registerUserGroupTSConfigFile(
  'my_sitepackage',
  'Configuration/TsConfig/User/news_editors.tsconfig',
  'News editors',
);
