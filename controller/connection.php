<?php
class Connection
{
    private $host       = 'mysql:host=localhost;dbname=e-wallet'; //or localhost
    private $database   = 'e-wallet';
    private $port       = 8081;
    private $user       = 'root';
    private $password   = '';

    public function  connecton()
    {
        try {
            $conn  = new PDO($this->host,  $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo 'Failed To Connected' . $e;
        }
    }
    function test()
    {
        print_r($this->user);
    }
}