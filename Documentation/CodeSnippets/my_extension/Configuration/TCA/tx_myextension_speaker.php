<?php

return [
  'ctrl' => [
    'title' => 'Speaker',
    'label' => 'name',
    'tstamp' => 'tstamp',
    'crdate' => 'crdate',
    'delete' => 'deleted',
    'default_sortby' => 'name',
    'enablecolumns' => [
      'disabled' => 'hidden',
    ],
    'typeicon_classes' => [
      'default' => 'status-user-frontend',
    ],
  ],
  'columns' => [
    'name' => [
      'label' => 'Name',
      'config' => [
        'type' => 'input',
        'required' => true,
      ],
    ],
    'company' => [
      'label' => 'Company',
      'config' => [
        'type' => 'input',
      ],
    ],
    'bio' => [
      'label' => 'Biography',
      'config' => [
        'type' => 'text',
        'enableRichtext' => true,
      ],
    ],
    'photo' => [
      'label' => 'Photo',
      'config' => [
        'type' => 'file',
        'maxitems' => 1,
        'allowed' => 'common-image-types',
      ],
    ],
  ],
  'types' => [
    '0' => [
      'showitem' => 'name, company, bio, photo, --div--;Access, hidden',
    ],
  ],
];
