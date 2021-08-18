<?php
$dbnya = $_POST["tablenya"];


echo "
public function __construct()
{
    ";
echo '$this->middleware("auth");';
echo "
}
";
