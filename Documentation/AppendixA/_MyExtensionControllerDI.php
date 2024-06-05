<?php

declare(strict_types=1);

namespace MyVendor\MyExtension\Controller;

use TYPO3\CMS\Core\Context\Context;

final class MyExtensionController
{
    public function __construct(
        private readonly Context $context,
    ) {}

    public function myAction()
    {
        $frontendUserUsername = $this->context->getPropertyFromAspect(
            'frontend.user',
            'username',
            '',
        );
    }
}
