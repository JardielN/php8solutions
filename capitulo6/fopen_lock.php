<?php
$file = fopen('C:/private/lock.txt', 'c');
// acquire an exclusive lock
flock($file, LOCK_EX);
?>