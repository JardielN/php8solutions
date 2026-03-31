<?php

$first = ['PHP' => 'Rasmus Lerdorf', 'JavaScript' => 'Brendan Eich', 'R' => 'Ross Ihaka'];
$second = ['Java' => 'James Gosling', 'R' => 'Hadley Wickham', 'Python' => 'Guido van Rossum'];
$lead_developers = $first + $second;
echo '<pre>';
print_r($lead_developers);
echo '</pre>';