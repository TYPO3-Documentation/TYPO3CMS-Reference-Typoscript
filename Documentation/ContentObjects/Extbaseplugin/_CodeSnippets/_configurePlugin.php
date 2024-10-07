<?php

use MyVendor\MyExtension\Controller\MyController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') || die('Access denied.');

ExtensionUtility::configurePlugin(
    'MyExtension',
    'MyPlugIn1',
    [MyController::class => 'list, show'],
    [],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
);
