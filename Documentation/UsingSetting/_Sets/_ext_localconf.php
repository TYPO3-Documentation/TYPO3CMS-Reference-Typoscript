<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

ExtensionManagementUtility::addTypoScript(
    'my_extension',
    'setup',
    '
        module.tx_form {
            settings {
                yamlConfigurations {
                    100 = EXT:my_site_package/Configuration/Form/CustomFormSetup.yaml
                }
            }
        }
    ',
);
