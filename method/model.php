<?php
$db = $_POST["databases"];
$dbnya = $_POST["tablenya"];
$method = $_POST["method"];
$fungsi = $_POST["fungsi"];
$success = new mysqli("localhost", "root", "", "$db");

$set = mysqli_query($success, "SHOW FIELDS FROM $dbnya");

$dbs = array();

while ($db = mysqli_fetch_row($set))
    $dbs[] = $db[0];

echo '
protected $DBGroup              = "default";
protected $table                = "' . $dbnya . '";
protected $primaryKey           = "' . $dbs[0] . '";
protected $useAutoIncrement     = true;
protected $insertID             = 1;
protected $returnType           = "object";
protected $useSoftDeletes       = false;
protected $protectFields        = false;
protected $allowedFields        = ["*"];

public function table()
{
    return $this->db->table($this->table);
}

public function put($data)
{
    return $this->db->table($this->table)->insert($data);
}

public function patch($data,$id)
{
    return $this->db->table($this->table)->update($data,["' . $dbs[0] . '"=>$id]);
}

public function remove($id)
{
    return $this->db->table($this->table)->delete(["' . $dbs[0] . '"=>$id]);
}

public function get($data)
{
    return $this->db->table($this->table)->where($data);
}
';
