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

echo '$id=$this->request->getVar("id");';
echo '&#13;';

echo '&#13;$save=$this->' . $dbnya . '->table()->delete(["' . $dbs[0] . '"=>$id]);';
echo '&#13;if($save){
    $message = [
        "message" => "Sukses Delete",
     ];
     return $this->respond($data, 200);
}
else {
    $message = [
        "message" => "Gagal Delete",
     ];
     return $this->respond($data, 400);
}';
