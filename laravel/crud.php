<?php
$dbnya = $_POST["tablenya"];
$request = '$request';
include('construct.php');

echo "public function get()
{
    ";
include('read.php');

echo "}
";
echo "public function store(Request $request)
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

echo "public function destroy(Request $request)
{
    ";
include('delete.php');
echo "}
";


echo "public function show($id)
{
    ";
include('select.php');
echo "}
";
