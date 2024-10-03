<?php

declare(strict_types=1);

namespace MyVendor\MyExtension\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class MyController extends ActionController
{
    public function listAction(): ResponseInterface
    {
        /** @var ContentObjectRenderer $contentObject */
        $contentObject = $this->request->getAttribute('currentContentObject');
        $dataFromTypoScript = $contentObject->data;
        $someValue = (int)($dataFromTypoScript['someValue'] ?? 0);
        $someSetting = $dataFromTypoScript['someSetting'] ?? '';
        // Do something
        return $this->htmlResponse();
    }
}
