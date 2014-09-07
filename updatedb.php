<?php
$server = "localhost";
$username = "bounce";
$password = "wesbounce";
$database = "bounce";

$connection = mysql_connect($server, $username, $password) or die
    ("Could not connect: " . mysql_error());

mysql_select_db($database, $connection);

$userid = $_POST["userid"];
$location = mysql_real_escape_string($_POST["location"]);

$sql = "INSERT INTO locations (id, location) ";
$sql .= "VALUES ('" . $userid . "', '" . $location . "') ";
$sql .= "ON DUPLICATE KEY UPDATE location='" . $location . "';";

if (!mysql_query($sql, $connection)) {
    die('Error: ' . mysql_error());
} else {
    echo "Location updated!";
}

mysql_close($connection);
?>