<?php

$person = [
    'primer nombre' => 'Jardiel',
    'primer apellido' => 'Ruiz',
    'ciudad' => 'Reynosa',
    'pais' => 'Mexico'
];
list('pais' => $pais,
'primer apellido' => $primer_apellido,
'primer nombre' => $primer_nombre) = $person;

echo"$primer_nombre $primer_apellido vive en $pais.";