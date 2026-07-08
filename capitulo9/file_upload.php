<?php
use Php8Solutions\File\Upload;
// set the maximum upload size in bytes
$max = 51200;
if(isset($_POST['upload'])){
    // define the path to the upload folder
    $path = 'C:/upload_test/';
    require_once __DIR__ . '/Php8Solutions/File/Upload.php';
    try {
        $loader = new Upload('image', $path, max:$max, mime:'application/pdf');
        $result = $loader->getMessages();
    } catch (Throwable $t) {
        echo $t->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if(isset($result))
    {
        echo '<ul>';
        foreach($result as $message)
        {
            echo "<li>$message</li>";
        }
        '</ul>';
    }
    ?>
    <form action="file_upload.php" method="post"
        enctype="multipart/form-data">
        <p>
            <label for="image">Upload image:</label>
            <input type="hidden" name="MAX_FILE_SIZE"
            value="<?=$max?>">
            <input type="file" name="image[]" id="image" multiple>
        </p>
        <p>
            <input type="submit" name="upload" value="Upload">
        </p>
    </form>
</body>

</html>