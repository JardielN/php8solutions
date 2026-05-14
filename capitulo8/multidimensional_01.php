<?php
require 'ListBuilder.php';
$wines = [
    'White' => [
        'California' => [
            'Chardonnay', 'Sauvignon blanc'
        ],
        'Burgundy' => [
            'Chardonnay', 'Pinot blanc'
        ]
    ],
    'Red' => [
        'California' => [
            'Merlot', 'Zinfandel'
        ],
        'Burgundy' => [
            'Pinot noir', 'Gamay'
        ]
    ]
];

echo new ListBuilder($wines);