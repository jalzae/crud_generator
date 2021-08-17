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

echo '&#13;$data=$this->' . $dbnya . '->table()->where(["' . $dbs[0] . '"=>$id])->get(1)->getRowArray();';


echo "&#13;";

echo 'return view("",$data);';
