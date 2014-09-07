<?php
$server = "localhost";
$username = "bounce";
$password = "wesbounce";
$database = "bounce";

$connection = mysql_connect($server, $username, $password) or die
    ("Could not connect : " + mysql_error());

mysql_select_db($database, $connection);

$pid = $_GET["pid"];

$sql = "SELECT fid FROM users WHERE pid=" . $pid . ";";
$result = mysql_query($sql, $connection) or die (mysql_error());
$json = [];

while ($row = mysql_fetch_assoc($result)) {
    array_push($json, $row["fid"]);
}

echo json_encode($json);

mysql_close($connection);
?>