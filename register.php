<?php
require("config.php");

/*** set a form token ***/
$form_token = md5(uniqid('auth', true));

/*** set the session form token ***/
$_SESSION['form_token'] = $form_token;
?>

<html>
<head>
    <title><?php echo $servername ?> Registration</title>
</head>

<body>
<h2>Register</h2>
<form action="register_submit.php" method="post">
    <fieldset>
        <p>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="" maxlength="20"/>
        </p>
        <p>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="" maxlength="20"/>
        </p>
        <p>
            <input type="hidden" name="form_token" value="<?php echo $form_token; ?>"/>
            <input type="submit" value="&rarr; Login"/>
        </p>
    </fieldset>
</form>
</body>
</html>