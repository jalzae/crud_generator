<?php
$db = $_POST["databases"];
$dbnya = $_POST["tablenya"];
$method = $_POST["method"];
$fungsi = $_POST["fungsi"];
$success = new mysqli("localhost", "root", "", "$db");

$set = mysqli_query($success, "SHOW FIELDS FROM $dbnya");

$dbs = array();
$id = '$id';
$request = '$request';
$update = '$update';
while ($db = mysqli_fetch_row($set))
    $dbs[] = $db[0];

echo "header('Content-Type: application/json');
$id = $request->$dbs[0];
$update = DB::table('barang')->where('$dbs[0]', $id)->delete();

if ($update) {
    return response()->json(array(
        'status' => 'SUCCESS',
        'message' => 'Berhasil',
    ), 200);
} else {
    return response()->json(array(
        'status' => 'ERROR',
        'message' => 'Gagal',
    ), 404);
}";
