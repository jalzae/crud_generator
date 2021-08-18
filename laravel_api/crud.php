<?php
$dbnya = $_POST["tablenya"];
$request="$request";
include('construct.php');

echo "public function index()
{
    ";
include('read.php');

echo "}
";
echo "public function create(Request $request)
{
    ";
include('create.php');
echo "}
";

echo "public function update(Request $request)
{
    ";
include('update.php');
echo "}
";

echo "public function delete(Request $request)
{
    ";
include('delete.php');
echo "}
";


echo "public function detail($id)
{
    ";
include('select.php');
echo "}
";
