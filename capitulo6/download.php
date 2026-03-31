<?php
// define the error page
$error = 'C:\xampp\htdocs\php8solutions\capitulo6\error.php';
// define the path to the download folder
$filepath = 'C:\xampp\htdocs\php8solutions\capitulo6\images';
$getfile = NULL;
// block any attempt to explore the filesystem
if (isset($_GET['file']) && basename($_GET['file']) == $_GET['file']) 
{
    $getfile = $_GET['file'];
}
else
{
    header("Location: $error");
    exit;
}
if($getfile)
{
    $path = $filepath . $getfile;
    // check that it exists and is readable
    if(file_exists($path) && is_readable($path))
    {
        // send the appropiate headers
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($path));
        header('Content-Disposition: attachment; filename='.$getfile);
        header('Content-Transfer-Encoding: binary');
        // output the file content
        readfile($path);
    }
    else
    {
        header("Location: $error");
    }
}
