<?php
$db = $_POST["databases"];
$dbnya = $_POST["tablenya"];
$method = $_POST["method"];
$fungsi = $_POST["fungsi"];
$success = new mysqli("localhost", "root", "", "$db");

$set = mysqli_query($success, "SHOW FIELDS FROM $dbnya");
$set1 = mysqli_query($success, "SHOW FIELDS FROM $dbnya WHERE Type NOT LIKE 'datetime'");
$set2 = mysqli_query($success, "SHOW FIELDS FROM $dbnya WHERE Type LIKE 'datetime'");

$input = array();
$input2 = array();
$dbs = array();
$dbs1 = array();

while ($inputdb = mysqli_fetch_row($set1))
    $input[] = $inputdb[0];
$hasil = count($input);

for ($i = 0; $i < $hasil; $i++) {
    print_r('&#13;$' . $input[$i] . '=$this->request->getVar("' . $input[$i] . '");');
}

while ($input2db = mysqli_fetch_row($set2))
    $input2[] = $input2db[0];
$hasil = count($input2);
for ($i = 0; $i < $hasil; $i++) {
    print_r('&#13;$' . $input2[$i] . '=date("Y-m-d H:i:s", strtotime("+12 hours"));');
}

echo '&#13;&#13;$data=[';
while ($db = mysqli_fetch_row($set))
    $dbs[] = $db[0];

$hasil = count($dbs);
for ($i = 1; $i < $hasil; $i++) {
    print_r('&#13;"' . $dbs[$i] . '"=>$' . $dbs[$i] . ',');
}
echo '&#13;];&#13;';

echo 'if ($this->validation->run($data, ' . $dbnya . ') == false) {
    $response = [
        "message" =>  $this->validation->getErrors(),
    ];
    return $this->respond($response, 400);
} else {';
echo '&#13;$save=$this->' . $dbnya . '->table()->update($data,["' . $input[0] . '"=>$' . $input[0] . ']);';

echo '&#13;if($save){
    $message = [
       "message" => "Sukses",
       "data" => $data,
    ];
    return $this->respond($message, 200);
}
else {
    $message = [
        "message" => "Gagal",
        "data" => $data,
     ];
     return $this->respond($message, 400);
}}';

mysqli_close($success);
