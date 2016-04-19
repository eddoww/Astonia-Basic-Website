<?php
require("config.php");
?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $servername ?></title>
    <meta name="description"
          content="<?php echo $servername ?> Server, a private server based on the source code from Astonia III">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Add your site or application content here -->
<p>Welcome to <?php echo $servername ?> Basic website.</p>

<p>Create an account: <a href="register.php">HERE</a></p>
<p>Old forum(for old references ;) ): <a href="http://shadowsofastonia.freeforums.net/">HERE</a></p>
<p>New forum (Use this one): <a href="forum">HERE</a></p>
<p>Login and create characters: <a href="login.php">HERE</a></p>
<p>Who is currently online check: <a href="whosonline.php">HERE</a></p>
<p>Top 25 levels on the server click: <a href="toplist.php">HERE</a></p>
<p>Download the game!: <a href="<?php echo $download_location ?>">HERE</a></p>
<p>In order to play this game, you must run it as administrator!</p>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<p>Credits to Eddow @ <a href="http://ugaris.com">Ugaris</a></p>

<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<?php include_once("analytics.php") ?>
</body>
</html>


