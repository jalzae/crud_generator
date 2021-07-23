<?php
$db = $_POST["databases"];
$dbnya = $_POST["tablenya"];
$method = $_POST["method"];
$fungsi = $_POST["fungsi"];
$success = new mysqli("localhost", "root", "", "$db");

$set = mysqli_query($success, "SELECT COL.COLUMN_NAME,COL.DATA_TYPE,COL.IS_NULLABLE,COL.COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS COL WHERE COL.TABLE_NAME='$dbnya' AND COL.TABLE_SCHEMA='$db'");
$set2 = mysqli_query($success, "SELECT COL.DATA_TYPE,COL.IS_NULLABLE,COL.COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS COL WHERE COL.TABLE_NAME='$dbnya' AND COL.TABLE_SCHEMA='$db'");
$set3 = mysqli_query($success, "SELECT COL.IS_NULLABLE FROM INFORMATION_SCHEMA.COLUMNS COL WHERE COL.TABLE_NAME='$dbnya' AND COL.TABLE_SCHEMA='$db'");
$set4 = mysqli_query($success, "SELECT COL.COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS COL WHERE COL.TABLE_NAME='$dbnya' AND COL.TABLE_SCHEMA='$db'");

$dbs = array();
$types = array();
$nulls = array();
$columntypes = array();

while ($db = mysqli_fetch_row($set))
    $dbs[] = $db[0];
while ($type = mysqli_fetch_row($set2))
    $types[] = $type[0];
while ($null = mysqli_fetch_row($set3))
    $nulls[] = $null[0];
while ($columntype = mysqli_fetch_row($set4))
    $columntypes[] = $columntype[0];


echo 'package models

import (
	"gorm.io/gorm"
	"time"
)

';

echo 'type ' . ucfirst($dbnya) . ' struct {
    ';

$hasil = count($dbs);

for ($i = 0; $i < $hasil; $i++) {
    echo $dbs[$i] . ' ';

    if ($types[$i] == "int") {
        echo "int ";
    } else if ($types[$i] == "varchar") {
        echo "string ";
    } else if ($types[$i] == "text") {
        echo "string ";
    } else if ($types[$i] == "datetime") {
        echo "time.Time ";
    }

    echo '`form:"' . $dbs[$i] . '" json:"' . $dbs[$i] . '" xml:"' . $dbs[$i] . '" ';

    if ($nulls[$i] == "NO") {
        echo 'binding:"required" ';
    }

    echo 'gorm:"column:' . $dbs[$i] . ';';

    if ($i == 0) {
        echo "primary_key;auto_increment;";
    }
    if ($types[$i] == "int" && $i != 0) {
        echo $columntypes[$i];
    } else if ($types[$i] == "varchar" & $i != 0) {
        echo $columntypes[$i];
    } else if ($types[$i] == "text" & $i != 0) {
        echo $columntypes[$i];
    } else if ($types[$i] == "datetime" & $i != 0) {
        echo $columntypes[$i];
    }

    if ($nulls[$i] == "NO") {
        echo 'not null';
    }



    echo '"`
    ';
}

echo 'table string `gorm:"-"`';

echo '
}

';

echo 'func (p ' . ucfirst($dbnya) . ') TableName() string {
	// double check here, make sure the table does exist!!
	if p.table != "" {
		return p.table
	}
	return "' . $dbnya . '" 
}

';
//model create
echo 'func Create' . $dbnya . '(db *gorm.DB, user *' . ucfirst($dbnya) . ') (err error) {
	err = db.Create(user).Error
	if err != nil {
		return err
	}
	return nil
}

';

///model getall
echo '
func Get' . $dbnya . 's(db *gorm.DB, user *[]' . ucfirst($dbnya) . ') (err error) {
	err = db.Find(user).Error
	if err != nil {
		return err
	}
	return nil
}

';


///model get detail 
echo '
func Get' . $dbnya . '(db *gorm.DB, user *' . ucfirst($dbnya) . ', usersId string) (err error) {
	err = db.Where("' . $dbs[0] . ' = ?", usersId).First(user).Error
	if err != nil {
		return err
	}
	return nil
}

';


//update user
echo 'func Update' . $dbnya . '(db *gorm.DB, user *' . ucfirst($dbnya) . ') (err error) {
	db.Save(user)
	return nil
}

';


//delete user
echo 'func Delete' . $dbnya . '(db *gorm.DB, user *' . ucfirst($dbnya) . ', usersId string) (err error) {
	db.Where("' . $dbs[0] . ' = ?", usersId).Delete(user)
	return nil
}';
