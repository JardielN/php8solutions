<?php
require_once 'csv_processor.php';

$scores = csv_processor('./scores.csv');

/*
foreach($scores as $score){
    [$home, $hscore, $away, $ascore] = $score;
    echo"$home $hscore:$ascore $away<br>";
}
*/

// Omite la primer fila para no mostrar titulos
// como en el bucle pasado
$scores->next();
while($scores->valid()){
    [$home, $hscore, $away, $ascore] = $scores->current();
    echo"$home $hscore:$ascore $away<br>";
    $scores->next();
}