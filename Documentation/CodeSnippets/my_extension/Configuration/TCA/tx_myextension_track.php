<?php

return [
  'ctrl' => [
    'title' => 'Track',
    'label' => 'title',
    'tstamp' => 'tstamp',
    'crdate' => 'crdate',
    'delete' => 'deleted',
    'default_sortby' => 'title',
    'enablecolumns' => [
      'disabled' => 'hidden',
    ],
    'typeicon_classes' => [
      'default' => 'mimetypes-x-content-text',
    ],
  ],
  'columns' => [
    'title' => [
      'label' => 'Title',
      'config' => [
        'type' => 'input',
        'required' => true,
      ],
    ],
    'color' => [
      'label' => 'Color',
      'config' => [
        'type' => 'color',
      ],
    ],
  ],
  'types' => [
    '0' => [
      'showitem' => 'title, color, --div--;Access, hidden',
    ],
  ],
];
