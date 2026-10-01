<?php

declare(strict_types=1);

namespace TYPO3\CMS\Backend\Form\Utility;

class FormEngineUtility
{
  protected static $allowOverrideMatrix = [
    'input' => ['size', 'max', 'readOnly'],
    'number' => ['size', 'readOnly'],
    'email' => ['size', 'readOnly'],
    'link' => ['size', 'readOnly'],
    'password' => ['size', 'readOnly'],
    'datetime' => ['size', 'readOnly'],
    'color' => ['size', 'readOnly'],
    'uuid' => ['size', 'enableCopyToClipboard'],
    'text' => ['cols', 'rows', 'wrap', 'max', 'readOnly'],
    'json' => ['cols', 'rows', 'readOnly'],
    'check' => ['cols', 'readOnly'],
    'select' => ['size', 'autoSizeMax', 'maxitems', 'minitems', 'readOnly', 'treeConfig', 'fileFolderConfig'],
    'category' => ['size', 'maxitems', 'minitems', 'readOnly', 'treeConfig'],
    'group' => ['size', 'autoSizeMax', 'maxitems', 'minitems', 'readOnly', 'elementBrowserEntryPoints'],
    'folder' => ['size', 'autoSizeMax', 'maxitems', 'minitems', 'readOnly', 'elementBrowserEntryPoints'],
    'inline' => ['appearance', 'behaviour', 'foreign_label', 'foreign_selector', 'foreign_unique', 'maxitems', 'minitems', 'size', 'autoSizeMax', 'symmetric_label', 'readOnly'],
    'file' => ['appearance', 'behaviour', 'maxitems', 'minitems', 'readOnly'],
    'imageManipulation' => ['ratios', 'cropVariants'],
  ];

  // ...
}
