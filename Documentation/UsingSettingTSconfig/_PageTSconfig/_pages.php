<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

ExtensionManagementUtility::registerPageTSConfigFile(
    'extension_name',
    'Configuration/TsConfig/Page/myPageTSconfigFile.tsconfig',
    'My special config'
);
