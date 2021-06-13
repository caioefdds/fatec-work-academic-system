<?php

class Connection
{
    private $server = 'localhost';

    private $username = 'root';

    private $password = '';

    private $dbname = 'project';

    protected $conn;

    function __construct() {
        $this->conn = new mysqli($this->server, $this->username, $this->password, $this->dbname);
    }

    protected function query($sql)
    {
        return $this->conn->query($sql);
    }
}