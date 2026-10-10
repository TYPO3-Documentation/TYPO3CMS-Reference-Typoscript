<?php

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die();

call_user_func(function () {
  $extensionKey = 'my_extension';
  $versionInformation = GeneralUtility::makeInstance(Typo3Version::class);
  if ($versionInformation->getMajorVersion() < 13) {
    ExtensionManagementUtility::addStaticFile(
      $extensionKey,
      'Configuration/Sets/Main',
      'My Extension, main TypoScript, always include',
    );
    ExtensionManagementUtility::addStaticFile(
      $extensionKey,
      'Configuration/Sets/WithACoolFeature',
      'My Extension, Cool feature',
    );
  }
});
