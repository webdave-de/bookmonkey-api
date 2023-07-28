<?php
class MyDataBase
{
    private $host = '';
    private $dbname = '';
    private $user = '';
    private $password = '';
    private $port = '';
    function __construct(
        $host,
        $dbname,
        $user,
        $password,
        $port

    ) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
        $this->port = $port;
    }

    function getConnection()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};port={$this->port};charset=utf8";

        return new PDO($dsn, $this->user, $this->password, [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_STRINGIFY_FETCHES => false
        ]);
    }
}