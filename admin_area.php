<?php
require("config.php");
if (!$_SESSION['login']['admin'] == "Y")
{
    header("Location: login.php");
    die("Redirecting to login.php");
}

try
{
    $stmt = $dbh->prepare("SELECT * FROM subscriber");
    $stmt->execute();
    $accounts = $stmt->fetchall();

    $stmt = $dbh->prepare("SELECT * FROM charinfo");
    $stmt->execute();
    $characters = $stmt->fetchall();

} catch (Exception $e)
{
    /*** if we are here, something is wrong in the database ***/
    $message = 'We are unable to process your request. Please try again later"';
}
?>
<p>Welcome to the super secret admin page! We do some magic tricks here!</p>

<h3>Accounts:</h3>
<table>
    <thead>
    <td>Account ID</td>
    <td>Username</td>
    <td>Creation Time</td>
    <td>Banned</td>
    <td>Admin</td>
    </thead>
    <tbody>
    <?php foreach ($accounts as $account)
    { ?>
        <tr>
    <td><?php echo $account['ID'] ?></td>
    <td><?php echo $account['email'] ?></td>
    <td><?php echo date("Y-m-d", $account['creation_time']) ?></td>
    <td><?php echo $account['banned'] ?></td>
    <td><?php echo $account['admin'] ?></td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<h3>Characters:</h3>
<p>(Characters in bolded/strong letters are currently online!)</p>
<table>
    <thead>
    <td>character ID</td>
    <td>Account ID</td>
    <td>Name</td>
    <td>Experience</td>
    <td>Creation Time</td>
    <td>Last Played</td>
    </thead>
    <tbody>
    <?php foreach ($characters as $character)
    {
        $username = $character['name'];
        if ($character['current_area'] != 0)
        {
            $username = "<strong>" . $character['name'] . "</strong>";
        } ?>
        <tr>
            <td><?php echo $character['ID'] ?></td>
            <td><?php echo $character['sID'] ?></td>
            <td><?php echo $username ?></td>
            <td><?php echo $character['experience'] ?></td>
            <td><?php echo date("Y-m-d", $character['creation_time']) ?></td>
            <td><?php echo date("Y-m-d", $character['login_time']) ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>