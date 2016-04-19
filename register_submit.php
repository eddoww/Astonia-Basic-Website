<?php
require("config.php");

/*** first check that both the username, password and form token have been sent ***/
if (!isset($_POST['username'], $_POST['password'], $_POST['form_token']))
{
    $message = 'Please enter a valid username and password';
} /*** check the form token is valid ***/
elseif ($_POST['form_token'] != $_SESSION['form_token'])
{
    $message = 'Invalid form submission';
} /*** check the username is the correct length ***/
elseif (strlen($_POST['username']) > 20 || strlen($_POST['username']) < 4)
{
    $message = 'Incorrect Length for Username';
} /*** check the password is the correct length ***/
elseif (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 4)
{
    $message = 'Incorrect Length for Password';
} /*** check the username has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['username']) != true)
{
    /*** if there is no match ***/
    $message = "Username must be alpha numeric";
} /*** check the password has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['password']) != true)
{
    /*** if there is no match ***/
    $message = "Password must be alpha numeric";
} else
{
    /*** if we are here the data is valid and we can insert it into database ***/
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    try
    {
        /*** prepare the insert ***/
        $stmt = $dbh->prepare("INSERT INTO subscriber (email, password, creation_time ) VALUES (:username, :password, :creation )");

        /*** bind the parameters ***/
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR, 40);
        $stmt->bindParam(':creation', time(), PDO::PARAM_STR);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** unset the form token session variable ***/
        unset($_SESSION['form_token']);

        /*** if all is done, say thanks ***/
        $message = 'Registration Succesful!';
        header("refresh:3;url=login.php");
    } catch (Exception $e)
    {
        /*** check if the username already exists ***/
        if ($e->getCode() == 23000)
        {
            $message = 'Username already exists';
        } else
        {
            /*** if we are here, something has gone wrong with the database ***/
            $message = 'We are unable to process your request. Please try again later"';
        }
    }
}
?>

    <html>
<head>
    <title><?php echo $servername ?> Login</title>
</head>
<body>
<p><?php echo $message; ?>
</body>
</html>
<?php include_once("analytics.php") ?>