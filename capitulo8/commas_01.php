<?php

$too_many = ['Dave Dee', 'Dozy', 'Beaky', 'Mick', 'Tich'];
function with_commas(array $array, int $max = 4)
{
    $length = count($array);
    $result = match($length)
    {
        0 => '',
        1 => array_pop($array),
        2 => implode(' and ', $array),
        $max + 1 => implode(', ', array_slice($array, 0, $max)) . ' and one other',
        default => implode(', ', array_slice($array, 0, $length-1)) .
        ' and ' . array_pop($array)
    };
    return $result;
}

echo with_commas($too_many);