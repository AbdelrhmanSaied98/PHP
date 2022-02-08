<?php
class db
{
    private $db_type = "mysql";
    private $host = "localhost";
    private $db_name = "PHP";
    private $username = "root";
    private $password = "";
    private $connection;

    function __construct()
    {
        $this->connection = new PDO("$this->db_type:
        host=$$this->host;
        dbname=$this->db_name","$this->username","$this->password");
    }
    function getConnection()
    {
        return $this->connection;
    }
    function select($col,$table,$condition = 1)
    {
        return $this->connection->query("select $col from $table where $condition");
    }
    function delete($table,$condition)
    {
        $this->connection->query("delete from $table where $condition");
    }
    function insert($table,$col,$student)
    {

        $this->connection->query("insert into $table ($col) VALUES(
            '$student->fName',
            '$student->lName',
            '$student->address',
            '$student->gender',
            '$student->department',
            '$student->username',
            '$student->password',
            '$student->img_name'

        )");
    }
    function update($table,$updatedData,$condition)
    {
        echo "update $table set $updatedData
        where $condition";
        $this->connection->query("update $table set $updatedData
            where $condition");
    }
    
}
?>