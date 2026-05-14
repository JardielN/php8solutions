<?php

// generator that yields each line of a CSV file as an array
function csv_processor($csv_file){
    // @ suprime los errores en si no abre.
    if(@!$file = fopen($csv_file, 'r')){
        echo "Can't open $csv_file.";
    }
    // es una funcion especializada:
    // busca la linea del archivo
    // detecta el delimitador (por ejemplo las comas)
    // converte la linea en un array de PHP
    // P.ej. Juan,Perez,25, $data es ['Juan', 'Perez', 25]
    // Seguira haciendo el recorrido mientras fgetcsv
    // llegue al final del archivo.
    while(($data = fgetcsv($file)) !== false){
        // A diferencia de 'return', yield es un generador
        // se usa para leer linea por linea
        yield $data;
    }
    fclose($file);
}