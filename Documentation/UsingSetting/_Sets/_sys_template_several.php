<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

ExtensionManagementUtility::addStaticFile(
  'my_extension',
  'Configuration/TypoScript/',
  'My Extension - Main TypoScript',
);

ExtensionManagementUtility::addStaticFile(
  'my_extension',
  'Configuration/TypoScript/SpecialFeature1/',
  'My Extension - Some special feature 1',
);

ExtensionManagementUtility::addStaticFile(
  'my_extension',
  'Configuration/TypoScript/SpecialFeature2/',
  'My Extension - Some special feature 2',
);
