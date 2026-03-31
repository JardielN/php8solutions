<?php

$images = ['image10.php', 'image9.php', 'image2.php'];
sort($images);
echo'<pre>';
echo 'sort(): ';
print_r($images);
echo'</pre>';

natsort($images);
echo'<pre>';
echo'natsort(): ';
print_r($images);
echo'</pre>';