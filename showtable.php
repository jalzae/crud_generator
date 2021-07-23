<?php
$dbnya = $_POST["data"];
$success = new mysqli("localhost", "root", "", "$dbnya");
$set = mysqli_query($success, "SHOW TABLES;");
$dbs = array();
$kabehdb = array();
while ($db = mysqli_fetch_row($set))
    $dbs[] = $db[0];

    $hasil = count($dbs);
    for ($i = 0; $i < $hasil; $i++) {
        print_r("<option value='$dbs[$i]'>" . $dbs[$i] . "</option>");
    }
    mysqli_close($success);
