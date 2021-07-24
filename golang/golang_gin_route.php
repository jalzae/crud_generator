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

echo '' . $dbnya . 'Repo := controllers.' . ucfirst($dbnya) . 'Controll()
r.POST("/' . $dbnya . '", auth, ' . $dbnya . 'Repo.Create' . $dbnya . ')
r.GET("/' . $dbnya . '", auth, ' . $dbnya . 'Repo.Get' . $dbnya . 's)
r.GET("/' . $dbnya . '/:id", auth, ' . $dbnya . 'Repo.Get' . $dbnya . ')
r.PUT("/' . $dbnya . '/:id", auth, ' . $dbnya . 'Repo.Update' . $dbnya . ')
r.DELETE("/' . $dbnya . '/:id", auth, ' . $dbnya . 'Repo.Delete' . $dbnya . ')';
