<?php
require("config.php");

/*** check if the users is already logged in ***/
if (isset($_SESSION['user_id']))
{
    $message = 'Users is already logged in';
}
/*** check that both the username, password have been submitted ***/
if (!isset($_POST['username'], $_POST['password']))
{
    $message = 'Please enter a valid username and password';
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

        /*** prepare the select statement ***/
        $stmt = $dbh->prepare("SELECT ID,email,first_name,last_name,address1,address2,address3,password,admin,locked,banned
				FROM subscriber
                    WHERE email = :username AND password = :password");

        /*** bind the parameters ***/
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR, 40);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** check for a result ***/
        $row = $stmt->fetch();
        $user_id = $row['ID'];
        /*** if we have no result then fail boat ***/
        if ($user_id == false)
        {
            $message = 'Login Failed';
        } /*** if we do have a result, all is well ***/
        else
        {
            /*** set the session user_id variable ***/
            $_SESSION['user_id'] = $user_id;
            unset($row['password']);
            $_SESSION['login'] = $row;

            /*** tell the user we are logged in ***/
            $message = 'You are now logged in! Redirecting you to the account management page!';
            header("refresh:3;url=account_management.php");
        }


    } catch (Exception $e)
    {
        /*** if we are here, something has gone wrong with the database ***/
        $message = 'We are unable to process your request. Please try again later"';
    }
}
?>

    <html>
    <head>
        <title><?php echo $servername ?></title>
    </head>
    <body>
    <p><?php echo $message; ?>
    </body>
    </html>
<?php include_once("analytics.php") ?>