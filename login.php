<?php
require("config.php");

if (!isset($_SESSION['user_id']))
{
    echo '<html>
<head>
    <title>' . $servername . 'Login</title>
</head>

<body>
<h2>Login Here</h2>
<form action="login_submit.php" method="post">
    <fieldset>
        <p>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="" maxlength="20" />
        </p>
        <p>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="" maxlength="20" />
        </p>
        <p>
            <input type="submit" value="→ Login" />
        </p>
    </fieldset>
</form>
</body>
</html>';
} else
{
    echo "you are already logged in! Redirecting you to account management page!";
    header("refresh:3;url=account_management.php");
}
?>
<?php include_once("analytics.php") ?>
