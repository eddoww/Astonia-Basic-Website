<?php
session_start();

// General stuff
$servername = "Astonia Server";
$download_location = "/downloads/Astonia_Installer.exe";
$analytics = "UA-51401830-13"; // Google analytics code, to keep track of people visiting your website EG: "UA-53434830-22"
$topTenExclusionList = [1];

//Database stuff
$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = '';
$mysql_dbname = 'merc';
$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Some functions to help out here n there ;)


// helps filtering bad names =)
function contains($str, array $arr)
{
    foreach ($arr as $a)
    {
        if (stripos($a, $str) !== false) return true;
    }

    return false;
}


?>