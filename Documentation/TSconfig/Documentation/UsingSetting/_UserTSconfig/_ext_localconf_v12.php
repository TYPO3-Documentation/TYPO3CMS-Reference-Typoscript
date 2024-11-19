<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die();

$versionInformation = GeneralUtility::makeInstance(Typo3Version::class);
// Only include user.tsconfig if TYPO3 version is below 13 so that it is not imported twice.
if ($versionInformation->getMajorVersion() < 13) {
    ExtensionManagementUtility::addUserTSConfig(
        '@import "EXT:my_sitepackage/Configuration/user.tsconfig"'
    );
}
