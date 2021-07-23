<?php
$db = $_POST["db"];
$dbnya = $_POST["data"];
$success = new mysqli("localhost", "root", "", "$db");
$set = mysqli_query($success, "SHOW FIELDS FROM $dbnya");
$dbs = array();
while ($db = mysqli_fetch_row($set))
    $dbs[] = $db[0];
print_r($dbs);
mysqli_close($success);
