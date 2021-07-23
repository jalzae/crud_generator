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
echo '&#13;$data=$this->' . $dbnya . '->table()->get()->getResult();';

echo "&#13;";

echo '&#13;if(count($data)!=0){
    $message = [
       "message" => "Sukses",
       "data" => $data,
    ];
    return $this->respond($data, 200);
}
else if (count($data)==0){
    $message = [
        "message" => "Sukses, but no data here",
        "data" => "No Data",
     ];
     return $this->respond($message, 201);
}
else {
    $message = [
        "message" => "Gagal",
        "data" => "No Data",
     ];
     return $this->respond($message, 400);
}';
