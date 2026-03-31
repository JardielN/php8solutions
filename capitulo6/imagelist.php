<form action="" method="post">
    <select name="pix" id="pix">
        <option value="">Select an image</option>
    <?php
    $files = new FilesystemIterator('../capitulo5/images');
    $images = new RegexIterator($files, '/\.(?:jpg|png|gif|webp)$/i');
    foreach ($images as $image) {
        $filename = $image->getFilename();
    ?>
        <option value="<?= $filename ?>"><?= $filename ?></option>
    <?php } ?>
    </select>
</form>