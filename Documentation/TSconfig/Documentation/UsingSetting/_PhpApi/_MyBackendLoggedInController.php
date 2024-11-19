<?php

declare(strict_types=1);

final class _MyBackendLoggedInController
{
    public function isUserToggleEnabled(): bool
    {
        // Typical call to retrieve a sanitized value:
        return $isToggleEnabled = (bool)($this->getUserTsConfig()['options.']['someToggle'] ?? false);
    }

    public function getSomePartWithSubToggles(): array
    {
        // Retrieve a subset, note the dot at the end:
        return $this->getUserTsConfig()['options.']['somePartWithSubToggles.'] ?? [];
    }

    private function getUserTsConfig(): array
    {
        return $GLOBALS['BE_USER']->getTSConfig();
    }
}
