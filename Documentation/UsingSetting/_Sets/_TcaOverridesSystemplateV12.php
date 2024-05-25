<?php

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die();

call_user_func(function () {
    $extensionKey = 'my-extension';
    $versionInformation = GeneralUtility::makeInstance(Typo3Version::class);
    if ($versionInformation->getMajorVersion() < 13) {
        ExtensionManagementUtility::addStaticFile(
            $extensionKey,
            'Configuration/Sets/MyExtension',
            'My Extension, main TypoScript, always include',
        );
        ExtensionManagementUtility::addStaticFile(
            $extensionKey,
            'Configuration/Sets/MyExtensionWithACoolFeature',
            'My Extension, Cool feature',
        );
    }
});
