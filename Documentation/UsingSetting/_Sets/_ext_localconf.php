<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

ExtensionManagementUtility::addTypoScript(
    'my_extension',
    'setup',
    "@import 'EXT:my_extension/Configuration/TypoScript/setup.typoscript'",
);
