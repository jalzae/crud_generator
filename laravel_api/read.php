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

echo "header('Content-Type: application/json');

$check = DB::table('$dbnya')->get();

if (count($check) == 0) {
    return response()->json(array(
        'message' => 'success but no data here',
        'results' => $check
    ), 201);
} else {
    return response()->json(array(
        'message' => 'success',
        'results' => $check
    ), 200);
}";
