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

$sql = "SELECT pid FROM users WHERE fid=" . $userid . ";";
$result = mysql_query($sql, $connection) or die (mysql_error());
if (mysql_num_rows($result) > 0) {
    $result = mysql_fetch_assoc($result);
    $sql = "UPDATE parties SET attendees=attendees-1 WHERE ";
    $sql .= "pid='" . $result["pid"] . "';";
    $result = mysql_query($sql, $connection) or die (mysql_error());

    $sql = "DELETE FROM parties WHERE attendees=0;";
    $result = mysql_query($sql, $connection) or die (mysql_error());
}
$sql = "INSERT INTO parties (location, attendees) ";
$sql .= "VALUES ('" . $location . "', 1)";
$sql .= "ON DUPLICATE KEY UPDATE attendees=attendees+1;";

if (!mysql_query($sql, $connection)) {
    die('Error: ' . mysql_error());
} else {
}

$sql = "SELECT pid FROM parties WHERE location='" . $location . "';";

$result = mysql_query($sql, $connection) or die (mysql_error());

$pid = mysql_fetch_assoc($result);
$pid = $pid["pid"];

$sql = "INSERT INTO users (fid, pid) VALUES ";
$sql .= "('" . $userid . "', " . $pid . ")";
$sql .= "ON DUPLICATE KEY UPDATE pid=" . $pid . ";";

if (!mysql_query($sql, $connection)) {
    die('Error: ' . mysql_error());
} else {
    echo "Location updated!";
}

mysql_close($connection);
?>