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
    function setBalance($balance, $walletNo)
    {
        try {
            $sql = $this->conn->prepare("UPDATE  wallet SET  wallet_balance = :balance 
                    
    WHERE wallet_number = :wallet_number ");

            $sql->execute([
                ':balance' => $balance,
                ':wallet_number' => $walletNo
                // ':auth' =>  $this->user
            ]);
            // print_r(self::$walletToken);
            // foreach (self::$walletToken as $key => $row) {
            //     if ($row['wallet_number'] == $walletNo) {
            //         self::$walletToken[$key]['wallet_balance'] += $balance;
            //     }
            // }
        } catch (\Throwable $th) {
            //throw $th;
            print_r($th);
        }
    }
}