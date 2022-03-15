<?php
require_once('DB.php');
class Wallet
{
    private $conn;
    private static $walletToken = [];
    private $user;
    function __construct()
    {
        $conn = new DB();
        $this->conn = $conn->getConn();
    }
    function setWallet($user)
    {
        $this->user = $user;
        $this->selectWallet();
    }
    function selectWallet()
    {
        $sql = $this->conn->prepare("SELECT *
        FROM wallet WHERE auth_id = :auth
        ");

        $sql->execute([
            ':auth' =>  $this->user
        ]);
        $rows = $sql->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $key => $row) {
            self::$walletToken[$key] = array('wallet_currency' => $row['wallet_currency'], 'wallet_number' => $row['wallet_number'], 'wallet_balance' => $row['wallet_balance']);
        }
    }

    public static function getWallets()
    {
        return  self::$walletToken;
    }
    function  setBalance($balance, $walletNo)
    {
        try {
            $sql = $this->conn->prepare("UPDATE  wallet SET  wallet_balance = :balance 
                    
    WHERE wallet_number = :wallet_number ");

            $sql->execute([
                ':balance' => $balance,
                ':wallet_number' => $walletNo
                // ':auth' =>  $this->user
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            print_r($th);
        }
    }
    function  pay($balance, $walletNo)
    {
        try {
            $sql = $this->conn->prepare("UPDATE  wallet SET  wallet_balance = :balance 
                    
    WHERE wallet_number = :wallet_number ");

            $sql->execute([
                ':balance' => $balance,
                ':wallet_number' => $walletNo
                // ':auth' =>  $this->user
            ]);
            return true;
        } catch (PDOException $th) {
            //throw $th;
            print_r($th);
            return false;
        }
    }
    function setOrder($total, $walletNo, $balance)
    {
        $sql = $this->conn->prepare("INSERT INTO orders (wallet_id  , created_at , total_price , current_balance  ) VALUES (
            (SELECT wallet_id FROM wallet WHERE wallet_number = :wallet_number ) , :created , :total , :balance)");

        $sql->execute([
            ':total' => $total,
            ':wallet_number' => $walletNo,
            ':created' =>  date("Y/m/d"),
            ':balance' => $balance
        ]);
    }
    function getOrders()
    {
        try {
            $sql = $this->conn->prepare("SELECT *
        FROM orders 
        ");

            $sql->execute();
            $rows = $sql->fetchAll(\PDO::FETCH_ASSOC);
            return $rows;
        } catch (PDOException $th) {
            print_r($th);
        }
    }
}