<?php
include_once  'connection.php';
class Auth extends Connection
{
    private $conn;
    private $token;
    function __construct()
    {
        $this->conn = $this->connecton();
    }
    function login($email)
    {
        $sql = $this->conn->prepare("SELECT auth_password 
        FROM auth WHERE auth_email = :email
        ");

        $sql->execute([
            ':email' =>  $email
        ]);
        $row = $sql->fetch();
        print_r($row);
        return $row;
    }
    function register($fullname, $email, $password)
    {
        try {
            $sql = $this->conn->prepare("INSERT INTO  auth 
                (auth_fullname  , auth_email , auth_password , is_active , created_at)
                 VALUES
                  (:fullname ,:email ,:pass , true , :created)");
            $sql->execute([
                ':fullname' => $fullname,
                ':email' => $email,
                ':pass' => $password,
                ':created' => date("Y/m/d")
            ]);
            $test = $this->conn->lastInsertId();
            print_r($test);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    function createWallet()
    {
        try {
            // create wallet for the user
            $length = 78;
            $token = bin2hex(random_bytes($length));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    function getToekn()
    {
        return $this->token;
    }
    function setToken()
    {
        $token = bin2hex(random_bytes(16));
        $this->token = $token;
    }
}