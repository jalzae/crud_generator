<?php
$dbnya = $_POST["tablenya"];

echo "
public function __construct()
{";
echo '$this->' . $dbnya . '=new Model' . $dbnya . ';';
echo "
}
";
