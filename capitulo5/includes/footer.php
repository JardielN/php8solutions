<footer>
    <?php
    $startYear = 1998;
    $thisYear = date('y');
    if($startYear == $thisYear)
    {
        $output = $startYear;
    }
    else
    {
        $output = "{$startYear}&ndash;{$thisYear}";
    }
    ?>
    <p>&copy; <?=$output?> Jardiel Ruiz</p>
</footer>