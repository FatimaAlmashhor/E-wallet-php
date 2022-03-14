<?php
include_once  'connection.php';
class Wallet extends Connection
{
    private $conn;
    private $walletToken = [];
    private $user;
    function __construct()
    {
        $this->conn = $this->connecton();
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
        foreach ($rows as $row) {
            $this->walletToken = array('wallet_currency' => $row['wallet_currency'], 'wallet_number' => $row['wallet_number'], 'wallet_balance' => $row['wallet_balance']);
        }
    }

    function getWallets()
    {
        print_r($this->walletToken);
        return $this->walletToken;
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
            print_r($this->walletToken);
            foreach ($this->walletToken as $key => $row) {
                if ($row['wallet_number'] == $walletNo) {
                    $this->walletToken[$key]['wallet_balance'] += $balance;
                }
            }
            print_r($this->walletToken);
        } catch (\Throwable $th) {
            //throw $th;
            print_r($th);
        }
    }
}