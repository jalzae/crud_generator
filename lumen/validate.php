<?php
$db = $_POST["databases"];
$dbnya = $_POST["tablenya"];
$method = $_POST["method"];
$fungsi = $_POST["fungsi"];
$success = new mysqli("localhost", "root", "", "$db");

$set = mysqli_query($success, "SELECT COL.COLUMN_NAME, COL.IS_NULLABLE FROM INFORMATION_SCHEMA.COLUMNS COL WHERE COL.TABLE_NAME='$dbnya' AND COL.IS_NULLABLE='NO' ");

$dbs = array();



echo '&#13;&#13;public $' . $dbnya . '=[';
while ($db = mysqli_fetch_row($set))
    $dbs[] = $db[0];

$hasil = count($dbs);
for ($i = 1; $i < $hasil; $i++) {
    print_r('&#13;"' . $dbs[$i] . '"=>"required",');
}

echo '&#13;];&#13;';


echo '&#13;&#13;public $' . $dbnya . '_errors=[';
while ($db = mysqli_fetch_row($set))
    $dbs[] = $db[0];

$hasil = count($dbs);
for ($i = 1; $i < $hasil; $i++) {
    print_r('&#13;"' . $dbs[$i] . '"=>[
        "required"  => "'.$dbs[$i].' wajib diisi."
    ],');
}

echo '&#13;];&#13;';

mysqli_close($success);
