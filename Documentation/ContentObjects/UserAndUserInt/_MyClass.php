<?php

declare(strict_types=1);

namespace MyVendor\MyExtension\UserFunctions;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Attribute\AsAllowedCallable;

class MyClass
{
  #[AsAllowedCallable]
  public function run(string $content, array $configuration, ServerRequestInterface $request): string
  {
    // Custom rendering logic
    return 'Something';
  }
}
