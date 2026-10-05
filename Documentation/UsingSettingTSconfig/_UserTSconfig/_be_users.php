<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

ExtensionManagementUtility::registerUserTSConfigFile(
  'my_sitepackage',
  'Configuration/TsConfig/User/editor.tsconfig',
  'Editor',
);
