<?php
$numbers = [2, 4, 7];
foreach ($numbers as &$number) 
{
    $number *= 2;
}
unset($number);
echo '<pre>';
print_r($numbers);
echo '</pre>';


$book = [
    'author' => 'David Powers',
    'title' => 'PHP 8 Solutions'
];
foreach ($book as $key => $value) {
    $book[ucfirst($key)] = $value;
    unset($book[$key]);
}
unset($value);
echo'<pre>';
print_r($book);
echo'</pre>';