<?php
$server = "localhost";
$username = "bounce";
$password = "wesbounce";
$database = "bounce";

$connection = mysql_connect($server, $username, $password) or die
    ("Could not connect: " . mysql_error());

mysql_select_db($database, $connection);

$userid = $_GET['userid'];

$sql = "SELECT * FROM locations WHERE id='" . $userid . "';";

$result = mysql_query($sql, $connection) or die (mysql_error());

echo json_encode(mysql_fetch_assoc($result));

header('Content-Type: application/json');

mysql_close($connection);
?>