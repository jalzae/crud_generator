<?php
$dbnya = $_POST["tablenya"];

echo 'Route::get("/' . $dbnya . '", ["' . $dbnya . '::class,"get"]");
';
echo 'Route::get("/' . $dbnya . '/{id}", ["' . $dbnya . '::class,"show"]");
';
echo 'Route::post("/' . $dbnya . '", ["' . $dbnya . '::class,"store"]");
';
echo 'Route::put("/' . $dbnya . '/{id}", ["' . $dbnya . '::class,"update"]");
';
echo 'Route::delete("/' . $dbnya . '/{id}", ["' . $dbnya . '::class,"destroy"]");
';
