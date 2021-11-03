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


public function getall()
{
    return $this->db->table($this->table)->get()->getResult();
}

public function getbyorder($column,$opsi)
{
    return $this->db->table($this->table)->orderBy($column,$opsi)->get()->getResult();
}

public function getrow($data)
{
    return $this->db->table($this->table)->where($data)->get(1)->getRowArray();
}

public function put($data)
{
    return $this->db->table($this->table)->insert($data);
}

public function putAll($data)
{
    return $this->db->table($this->table)->insertBatch($data);
}

public function patch($data,$id)
{
    return $this->db->table($this->table)->update($data,["' . $dbs[0] . '"=>$id]);
}

public function patchAll($data,$condition)
{
    return $this->db->table($this->table)->update($data,$condition);
}

public function remove($id)
{
    return $this->db->table($this->table)->delete(["' . $dbs[0] . '"=>$id]);
}

public function removeAll($id)
{
    return $this->db->table($this->table)->delete($id);
}

public function get($data)
{
    return $this->db->table($this->table)->where($data);
}

public function getdata($data)
{
    return $this->db->table($this->table)->where($data)->get()->getResult();
}

public function getdatabyorder($data, $column, $asc)
{
    return $this->db->table($this->table)->where($data)->orderBy($column, $asc)->get()->getResult();
}
';
