<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using RegexIterator</title>
</head>
<body>
    <pre>
        <?php
        $files = new FilesystemIterator('.');
        $files = new RegexIterator($files, '/\.(?:txt|csv)$/i');
        foreach($files as $file)
        {
            echo $file->getFilename(). '<br>';
        }
        ?>
    </pre>
</body>
</html>