<?php
$db = $_POST["databases"];
$dbnya = $_POST["tablenya"];
$method = $_POST["method"];
$fungsi = $_POST["fungsi"];
$success = new mysqli("localhost", "root", "", "$db");

$set = mysqli_query($success, "SHOW FIELDS FROM $dbnya");

$dbs = array();

$product = '$product';
$product1 = '$product1';
$id = '$id';
$data='$data';

while ($db = mysqli_fetch_row($set))
    $dbs[] = $db[0];
echo "//// You must sett $id inside function
";
echo "$product =  DB::table('$dbnya')->where('$dbs[0]', $id)->get();
$product1 =  DB::table('$dbnya')->where('$dbs[0]', $id)->first();

if (count($product) == 0) {
    return response()->json([
        'status' => 'nodata',
        'message' => 'nodata',
        'data' => $product
    ], 400);
} else {
    $data = [
        'status' => 'success',
        'message' => 'data exist',
        'data' => $product
    ];
    return response()->json($product1, 200);
}";
