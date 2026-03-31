<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using FilesystemIterator()</title>
</head>
<body>
    <pre>
        <?php
        $files = new FilesystemIterator('../capitulo5/images');
        foreach($files as $file)
        {
            echo $file . '<br>';
        }
        ?>
    </pre>
</body>
</html>