<?php
$db = $_POST["databases"];
$dbnya = $_POST["tablenya"];
$method = $_POST["method"];
$fungsi = $_POST["fungsi"];
$success = new mysqli("localhost", "root", "", "$db");

$set = mysqli_query($success, "SHOW FIELDS FROM $dbnya");

$dbs = array();

while ($db = mysqli_fetch_row($set))
    $dbs[] = $db[0];

echo "header('Content-Type: application/json');

";
$hasil = count($dbs);
for ($i = 0; $i < $hasil; $i++) {
    print_r('$' . $dbs[$i] . '"=$request->' . $dbs[$i] . ';&#13;');
}


echo '

$data = [   ';

$hasil = count($dbs);
for ($i = 1; $i < $hasil; $i++) {
    print_r('&#13;"' . $dbs[$i] . '"=>$' . $dbs[$i] . ',');
}
echo '
];

$valid = [
';
$hasil = count($dbs);
for ($i = 1; $i < $hasil; $i++) {
    print_r('$' . $dbs[$i] . '"=>' . $dbs[$i] . ',&#13');
}

echo '
];';

echo '
$validator= Validator::make($request->all(), $valid);

if ($validator->fails()) {
    return response()->json(array(
        "status"=> "ERROR",
        "message" => $validator->errors(),
    ), 404);
} else {
    $save = DB::table("' . $dbnya . '")->where('.$dbs[0].',$'.$dbs[0].')->update($data);

    if ($save) {
        return response()->json(array(
            "status" => "SUCCESS",
            "message" => "Berhasil",
            "results" => $data
        ), 200);
    } else {
        return response()->json(array(
            "status" => "ERROR",
            "message" => "Gagal",
            "results" => $data
        ), 404);
    }
}';
