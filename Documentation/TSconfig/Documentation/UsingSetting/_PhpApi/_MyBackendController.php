<?php

declare(strict_types=1);

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;

final class MyBackendController
{
    public function someMethod(int $currentPageId): void
    {
        // Retrieve user TSconfig of currently logged in user
        $userTsConfig = $this->getBackendUser()->getTSConfig();

        // Retrieve page TSconfig of the given page id
        $pageTsConfig = BackendUtility::getPagesTSconfig($currentPageId);
    }

    private function getBackendUser(): BackendUserAuthentication
    {
        return  $GLOBALS['BE_USER'];
    }
}
