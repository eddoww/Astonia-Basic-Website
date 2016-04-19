<?php
require("config.php");

if (!isset($_SESSION['user_id']))
{
    $message = 'You must be logged in to access this page';
    header("Location: login.php");
    die("Redirecting to login.php");
} else
{

    try
    {
        /*** prepare the insert ***/
        $stmt = $dbh->prepare("SELECT * FROM subscriber
        WHERE ID = :user_id");

        /*** bind the parameters ***/
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** check for a result ***/
        $username = $stmt->fetch();

        $stmt = $dbh->prepare('SELECT * FROM charinfo WHERE sID = :sID ORDER BY experience');
        $stmt->execute(array('sID' => $_SESSION['user_id']));
        $result_chars = $stmt->fetchAll();

        /*** if we have no something is wrong ***/
        if ($username == false)
        {
            $message = 'Access Error';
        } else
        {
            $message = 'Welcome ' . $username['email'] . " Your account ID is:" . $_SESSION['user_id']; ?>


            <?php
        }
    } catch (Exception $e)
    {
        /*** if we are here, something is wrong in the database ***/
        $message = 'We are unable to process your request. Please try again later"';
    }
}

?>

    <html>
<head>
    <title>Members Only Page</title>
</head>
<body>
<h2><?php echo $message; ?></h2>
<pre>
</pre>
<p><a href="logout.php">Do you wish to logout? Click on me!</a></p>
<p> Here is a list of your characters and their karma:</p>
<br/>
<table class="table table-condensed chartable">
    <tr>
        <td>Character name:</td>
        <td>Level:</td>
        <td>Karma:</td>
        <td>Locked:</td>
    </tr>
    <?php
    if (count($result_chars))
    {
        $datasetCount = count($result_chars); // returns count of array items of any array
        echo "<h3>You currently have $datasetCount characters. Maximum is 36.</h3>";
        echo "<br />";
        foreach ($result_chars as $row)
        {
            $exp = floor(pow($row['experience'] + 1, 1 / 4));
            echo '<tr>';
            echo "<td>>" . $row['name'] . "</td>";
            echo "<td>" . $exp . "</td>";
            echo "<td>" . $row['karma'] . "</td>";
            echo "<td>" . $row['locked'] . "</td>";
            echo '</tr>';
        }
    } else
    {
        echo "No characters created.";
    }
    ?>

</table>


<?php $datasetCount = count($result_chars);
if ($datasetCount < 36)
{
    echo '<form id="charcreate" method="post" action="create_character_submit.php" class="form-horizontal">
<fieldset>
<!-- Form Name -->
<legend style="text-align: center">Create Character</legend>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="name">Character name:</label>
  <div class="col-md-4">
  <input id="name" name="name" type="text" placeholder="" class="form-control input-md" required="">

  </div>
</div>
<!-- Multiple Radios (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Gender">Character gender:</label>
  <div class="col-md-4">
    <label class="radio-inline" for="Gender-0">
      <input type="radio" name="Gender" id="Gender-0" value="1">
      Male
    </label>
    <label class="radio-inline" for="Gender-1">
      <input type="radio" name="Gender" id="Gender-1" value="2">
      Female
    </label>
  </div>
</div>
<!-- Multiple Radios (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="charclass">Character Class:</label>
  <div class="col-md-4">
    <label class="radio-inline" for="charclass-0">
      <input type="radio" name="charclass" id="charclass-0" value="2">
      Warrior
    </label>
    <label class="radio-inline" for="charclass-1">
      <input type="radio" name="charclass" id="charclass-1" value="1">
      Mage
    </label>
  </div>
</div>
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="">
    <button type="submit" class="btn btn-warning">submit</button>
  </div>
</div>
</fieldset>
</form>';
} else
{
    echo 'You have reached the maximum amount of characters. Please delete some to make new characters';
}
?>

<p><a href="index.php">Back to index</a></p>
</body>
</html>
<?php include_once("analytics.php") ?>