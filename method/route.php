<?php
$dbnya = $_POST["tablenya"];

echo '$routes->get("/' . $dbnya . '", "' . $dbnya . '::get' . $dbnya . '");
';
echo '$routes->post("/create' . $dbnya . '", "' . $dbnya . '::create' . $dbnya . '");
';
echo '$routes->post("/update' . $dbnya . '", "' . $dbnya . '::update' . $dbnya . '");
';
echo '$routes->post("/delete' . $dbnya . '", "' . $dbnya . '::delete' . $dbnya . '");
';
echo '$routes->post("/detail' . $dbnya . '", "' . $dbnya . '::detail' . $dbnya . '");
';
