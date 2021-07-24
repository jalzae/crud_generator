<?php
$db = $_POST["databases"];
$dbnya = $_POST["tablenya"];
$method = $_POST["method"];
$fungsi = $_POST["fungsi"];
$success = new mysqli("localhost", "root", "", "$db");


echo "router$dbnya  = require('./routes/$dbnya');
";
echo "app.use('/$dbnya', router$dbnya);";
