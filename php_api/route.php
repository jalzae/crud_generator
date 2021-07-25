<?php
$dbnya = $_POST["tablenya"];

echo '$routes->get("/' . $dbnya . '", "' . $dbnya . '::get' . $dbnya . '");
';
echo '$routes->post("/' . $dbnya . '", "' . $dbnya . '::create' . $dbnya . '");
';
echo '$routes->put("/' . $dbnya . '", "' . $dbnya . '::update' . $dbnya . '");
';
echo '$routes->delete("/' . $dbnya . '", "' . $dbnya . '::delete' . $dbnya . '");
';
echo '$routes->get("/' . $dbnya . '/(:num)", "' . $dbnya . '::detail' . $dbnya . '/$id");
';
