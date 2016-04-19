<?php
require("config.php");

$sID = $_SESSION['user_id'];
$name = ucfirst(strtolower(($_POST['name'])));

if (strlen($name) <= 3)
{
    die("This Character name has to few characters, minimum is 4.");
}
if (strlen($name) >= 16)
{
    die("This Character name has to much characters, maximum is 15.");
}
$gender = 'unselected';
$class = 'unselected';
$select_gender = ($_POST['Gender']);
if ($select_gender == '1')
    $gender = 'M';
else if ($select_gender == '2')
    $gender = 'F';
$select_class = ($_POST['charclass']);
if ($select_class == '1')
    $class = 'M';
else if ($select_class == '2')
    $class = 'W';
$query = "
SELECT
1
FROM charinfo
WHERE
name = :name
";
$query_params = array(':name' => $_POST['name']);
try
{
    $stmt = $dbh->prepare($query);
    $result = $stmt->execute($query_params);
} catch (PDOException $ex)
{
    die("Failed to run query: " . $ex->getMessage());
}
$row = $stmt->fetch();
if ($row)
{
    die("This Character name is already registered");
}
$query = "
SELECT
*
FROM badname
WHERE
bad LIKE ?
";
$cname = '%' . $_POST['name'] . '%';
$query_params = array($cname);
try
{
    $stmt = $dbh->prepare($query);
    $result = $stmt->execute($query_params);
} catch (PDOException $ex)
{
    die("Failed to run query: " . $ex->getMessage());
}
$row = $stmt->fetch();
if ($row)
{
    die("This Character name is not allowed");
}
$genclass = $gender . $class;
$old_path = getcwd();
$output = shell_exec("./create_character $sID $name $genclass");
header("Location: account_management.php"); ?>`
<?php include_once("analytics.php") ?>