<?php
require("config.php");
$stmt = $dbh->prepare('SELECT * FROM charinfo ORDER BY experience DESC LIMIT 0,34;');
$stmt->execute();
$result = $stmt->fetchAll();
$place = 1;
foreach ($result as $index => $item)
{
    switch ($item['ID'])
    {
        case 1:
            unset($result[$index]);
            break;
        case 3:
            unset($result[$index]);
            break;
        case 29:
            unset($result[$index]);
            break;
        case 7:
            unset($result[$index]);
            break;
        case 13:
            unset($result[$index]);
            break;
        case 10:
            unset($result[$index]);
            break;
        case 14:
            unset($result[$index]);
            break;
        case 12:
            unset($result[$index]);
            break;
        case 9:
            unset($result[$index]);
            break;
        case 11:
            unset($result[$index]);
            break;
        case 8:
            unset($result[$index]);
            break;
    }
    $today = time();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>toplist</title>
</head>
<body>
<h1 class="text-center">Top 25 Character List</h1>
</br>
</br>
<table class="table table-condensed table-striped toplist">
    <tr>
        <th style="width: 10%">Rank:</th>
        <th style="width: 40%">Character name:</th>
        <th style="width: 10%">Level:</th>
    </tr>
    <tr></tr>
    <tr>



    <?php foreach ($result as $index => &$item)
    {

        $exp = floor(pow($item['experience'] + 1, 1 / 4));
        $name = $item['name'];
        echo '<tr>';
        echo "<td>" . $place++ . "</td>";
        echo "<td>" . $name . "</td>";
        echo "<td>" . $exp . "</td>";
        echo '</tr>';
    } ?>
    <?php include_once("analytics.php") ?>
</body>
</html>
