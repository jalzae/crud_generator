<?php
$dbnya = $_POST["tablenya"];

include('construct.php');

echo "public function create$dbnya()
{
    ";
include('create.php');

echo "}
";
echo "public function get$dbnya()
{
    ";
include('read.php');
echo "}
";

echo "public function update$dbnya()
{
    ";
include('update.php');
echo "}
";

echo "public function delete$dbnya()
{
    ";
include('delete.php');
echo "}
";


echo "public function detail$dbnya()
{
    ";
include('select.php');
echo "}
";
