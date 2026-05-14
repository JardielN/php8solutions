<?php
$locations = [];
$json = file_get_contents('./film_locations.json');
$data = json_decode($json, true);
$col_names = array_column($data['meta']['view']['columns'], 'name');

foreach($data['data'] as $datum){
    $locations[] = array_combine($col_names, $datum);
}

$search = 'Pier 7';
$getLocation = fn($location) => str_contains($location['Locations'],
$search);

$filtered = array_filter($locations, $getLocation);
echo '<ul>';
foreach($filtered as $item){
    echo "<li>{$item['Title']} ({$item['Release Year']}) filmed
    at {$item['Locations']}</li>";
}
echo '</ul>';