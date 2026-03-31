<?php

// Custom Sorting With the Spaceship Operator

$playlist = [
    ['artist' => 'Jethro Tull', 'track' => 'Locomotive Breath'],
    ['artist' => 'Dire Straits', 'track' => 'Telegraph Road'],
    ['artist' => 'Mumford and Sons', 'track' => 'Broad-Shouldered Beasts'],
    ['artist' => 'Ed Sheeran', 'track' => 'Nancy Mulligan'],
    ['artist' => 'Jethro Tull', 'track' => 'Aqualung'],
    ['artist' => 'Mumford and Sons', 'track' => 'Thistles and Weeds'],
    ['artist' => 'Ed Sheeran', 'track' => 'Eraser']
];

// asort($playlist); Ordenamiento alfabetico por 'artist'

// Ordenamiento alfabetico por 'track'
usort($playlist, fn($a, $b) => $b['track'] <=> $a['track']);

echo'<ul>';
foreach($playlist as $item){
    echo"<li>{$item['artist']}: {$item['track']}</li>";
}
echo'</ul>';