<?php
require("config.php");
$stmt = $dbh->prepare('SELECT * FROM charinfo ORDER BY experience DESC LIMIT 0,34;');
$stmt->execute();
$result = $stmt->fetchAll();
if (isset($topTenExclusionList)) {
    $result = array_filter($stmt->fetchAll(), function ($value) use ($topTenExclusionList) {
        return !in_array($value['ID'], $topTenExclusionList);
    });
}
$place = 1;

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
