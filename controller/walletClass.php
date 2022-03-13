<?php
include_once  'connection.php';
class Wallet extends Connection
{
    private $conn;
    private $walletToken = [];
    private $user;
    function __construct($user)
    {
        $this->user = $user;
        $this->conn = $this->connecton();
        $this->selectWallet();
    }

    function getWallets()
    {
        return $this->walletToken;
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
        foreach ($rows as $row)
            array_push($this->walletToken, $row['wallet_number']);
    }
    function getBallence()
    {
        $sql = $this->conn->prepare("SELECT wallet_ballence
        FROM wallet WHERE auth_id = :auth
        ");

        $sql->execute([
            ':auth' =>  $this->user
        ]);
        $rows = $sql->fetchAll();
    }
}