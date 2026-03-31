<?php

$first = [
    'PHP' => 'Rasmus Lerdorf',
    'JavaScript' => 'Brendan Eich',
    'R' => 'Robert Gentleman'
];

$second = [
    'Java' => 'James Gosling',
    'R' => 'Ross Ihaka',
    'Python' => 'Guido van Rossum'
];

$diff = array_diff_assoc($first, $second);
echo '<pre>';
print_r($diff);
echo '</pre>';