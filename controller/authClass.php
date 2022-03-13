<?php
include_once  'connection.php';
class Auth extends Connection
{
    private $conn;
    private $walletToken;
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
            $auth_id = $this->conn->lastInsertId();
            $result = $this->createWallet($auth_id);
            return  $result;
        } catch (\Throwable $th) {
            return false;
        }
    }
    function createWallet($auth_id)
    {
        try {
            // create wallet for the user
            $length = 78;
            $token = bin2hex(random_bytes($length));
            $this->walletToken = $token;
            $sql = $this->conn->prepare("INSERT INTO  wallet 
                (auth_id  , create_time  , wallet_number  , is_active )
                 VALUES
                  (:auth ,:created ,:walletNo , true )");
            $sql->execute([
                ':auth' => $auth_id,
                ':created' => date("Y/m/d"),
                ':walletNo' => $token,
            ]);
            $this->conn->lastInsertId();

            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }
    function getToekn()
    {
        return $this->walletToken;
    }
    function setToken()
    {
        // $token = bin2hex(random_bytes(16));
        // $this->token = $token;
    }
}