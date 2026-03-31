<?php
echo file('C:/private/sonnet.txt')[10];

/*
// Replace new lines with spaces
$words = str_replace("\r\n", ' ', $sonnet);
// Split into an array of words
$words = explode(' ', $words);
// extract the first nine array elements
$first_line = array_slice($words, 0, 9);
// Join the first nine elements and display
echo implode(' ', $first_line);
*/
