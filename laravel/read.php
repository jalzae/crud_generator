<?php
$db = $_POST["databases"];
$dbnya = $_POST["tablenya"];
$method = $_POST["method"];
$fungsi = $_POST["fungsi"];
$success = new mysqli("localhost", "root", "", "$db");

$set = mysqli_query($success, "SHOW FIELDS FROM $dbnya");

$dbs = array();
$check = '$check';

while ($db = mysqli_fetch_row($set))
    $dbs[] = $db[0];

echo "

$check = DB::table('$dbnya')->get();
return view('', $check);
";
