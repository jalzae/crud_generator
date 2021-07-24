<?php
$db = $_POST["databases"];
$dbnya = $_POST["tablenya"];
$method = $_POST["method"];
$fungsi = $_POST["fungsi"];
$success = new mysqli("localhost", "root", "", "$db");


$set = mysqli_query($success, "SELECT COL.COLUMN_NAME,COL.DATA_TYPE,COL.IS_NULLABLE,COL.COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS COL WHERE COL.TABLE_NAME='$dbnya' AND COL.TABLE_SCHEMA='$db'");
$setnull = mysqli_query($success, "SELECT COL.COLUMN_NAME,COL.DATA_TYPE,COL.IS_NULLABLE,COL.COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS COL WHERE COL.TABLE_NAME='$dbnya' AND COL.TABLE_SCHEMA='$db' AND COL.IS_NULLABLE='YES'");

$dbs = array();

while ($db = mysqli_fetch_row($set))
    $dbs[] = $db[0];

echo "const express = require('express');
const router = express.Router();
const config = require('../config/knex');
const knex = require('knex')(config);
const authJwt = require('../middleware/authJwt');

";
///get all user
echo "router.get('/',authJwt, async(req, res) => {
    try {
        let $dbnya = await knex('$dbnya');
        res.json($dbnya)
    } catch (e) {
        console.log(e);
    }
})

";

/// insert data
echo "router.post('/',authJwt, async(req, res) => {
    try { ";
$hasil = count($dbs);
for ($i = 1; $i < $hasil; $i++) {
    echo "
        let $dbs[$i] = req.body.$dbs[$i];
        ";
}

echo "
        let id = await knex('$dbnya').insert({";

for ($i = 1; $i < $hasil; $i++) {
    echo "
        '$dbs[$i]': $dbs[$i],
        ";
}

echo "})
        res.json({
            ";

for ($i = 0; $i < $hasil; $i++) {
    if ($i == 0) {
       
    } else {
        echo "
        $dbs[$i],
        ";
    }
}

echo "})
    } catch (e) {
        console.log(e);
        next(e)
    }
})

";

///update user 

echo "
router.put('/:id',authJwt, async(req, res) => {
    try {
        ";
$hasil = count($dbs);
for ($i = 0; $i < $hasil; $i++) {
    echo "
        let $dbs[$i] = req.body.$dbs[$i];
        ";
}

echo "await knex('$dbnya').where('$dbs[0]', $dbs[0]).update({
            ";

for ($i = 1; $i < $hasil; $i++) {
    echo "
        '$dbs[$i]': $dbs[$i],
        ";
}

echo "
        })
        res.json({
            ";

for ($i = 0; $i < $hasil; $i++) {

    echo "
        $dbs[$i],
        ";
}

echo "
        })
    } catch (e) {
        console.log(e);
        next(e)
    }
})";

///get detail user
echo "
router.get('/:id', authJwt, async(req, res, next) => {
    try {
        let id = req.params.id;

        let $dbnya = await knex('$dbnya').where('$dbs[0]', id);
        res.json({
            $dbnya
        })
    } catch (e) {
        console.log(e);
        next(e)
    }
})

";

echo "
router.delete('/:id',authJwt, async(req, res) => {
    try {
        let id = req.params.id;

        await knex('$dbnya').where('$dbs[0]', id).del()
        res.json({
            id,
        })
    } catch (e) {
        console.log(e);
        next(e)
    }
})

module.exports = router";
