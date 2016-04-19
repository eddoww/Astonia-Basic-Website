<?php
require("config.php");

try
{

    $area = 0;
    $stmt = $dbh->prepare('SELECT * FROM charinfo WHERE current_area != :area ORDER BY current_area');
    $stmt->execute(array('area' => $area));
    $result = $stmt->fetchAll();
} catch (Exception $e)
{
    /*** if we are here, something has gone wrong with the database ***/
    $message = 'We are unable to process your request. Please try again later"';
}


if (count($result))
{
    $datasetCount = count($result); // returns count of array items of any array
    echo "<h3 class='text-center'>There are currently $datasetCount players online on $servername</h3>";
    echo '<table id="sortonline" class="table table-condensed table-striped toplist">
                <thead>
                        <tr>
                            <th style="width: 25%">Character name:</th>
                            <th style="width: 10%">Level:</th>
                            </tr></thead>';

    foreach ($result as $row)
    {
        $exp = floor(pow($row['experience'] + 1, 1 / 4));
        $curr_area = $row['current_area'];

        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $exp . "</td>";
    }
} else
{
    echo '<h3> Nobodies currently online boiisss </h3>';
}

?>
<?php include_once("analytics.php") ?>
