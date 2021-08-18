<?php
$dbnya = $_POST["tablenya"];

echo '$routes->get("/' . $dbnya . '", "' . $dbnya . '@index");
';
echo '$routes->post("/' . $dbnya . '", "' . $dbnya . '@create");
';
echo '$routes->put("/' . $dbnya . '/{id}", "' . $dbnya . '@update");
';
echo '$routes->delete("/' . $dbnya . '/{id}", "' . $dbnya . '@delete");
';
echo '$routes->get("/' . $dbnya . '/{id}", "' . $dbnya . '@detail");
';
