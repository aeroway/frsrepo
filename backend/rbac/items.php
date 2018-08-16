<?php
return [
    'editMfc' => [
        'type' => 2,
        'description' => 'Can do actions like a MFC user',
    ],
    'editZkp' => [
        'type' => 2,
        'description' => 'Can do actions like a ZKP user',
    ],
    'mfc' => [
        'type' => 1,
        'children' => [
            'editMfc',
        ],
    ],
    'zkp' => [
        'type' => 1,
        'children' => [
            'editZkp',
        ],
    ],
];
