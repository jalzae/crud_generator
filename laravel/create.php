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

$hasil = count($dbs);
for ($i = 1; $i < $hasil; $i++) {
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
    print_r($validator->errors());
} else {
    $save = DB::table("' . $dbnya . '")->insert($data);

    if ($save) {
        echo "Berhasil Save";
    } else {
        echo "Gagal Save";
    }
}';
