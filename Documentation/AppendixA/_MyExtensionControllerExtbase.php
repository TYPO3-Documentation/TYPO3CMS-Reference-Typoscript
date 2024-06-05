<?php

declare(strict_types=1);

namespace MyVendor\MyExtension\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

final class MyExtensionController extends ActionController
{
    public function myAction(): ResponseInterface
    {
        // Note the 'user' property is marked @internal.
        $frontendUserUsername = $this->request
            ->getAttribute('frontend.user')->user['username'];
        $this->view->assign('username', $frontendUserUsername);
        return $this->htmlResponse();
    }
}
