<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using RecursiveDirectoryIterator</title>
</head>
<body>
    <pre>
        <?php
        $files = new RecursiveDirectoryIterator('../capitulo5/images');
        $files->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($files);
        foreach($files as $file)
        {
            echo $file->getRealPath(). '<br>';
        }
        ?>
    </pre>
</body>
</html>