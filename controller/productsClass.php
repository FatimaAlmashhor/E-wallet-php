<?php
require_once('DB.php');
require_once('DBInterface.php');
class Products implements CRUDInterface
{
    private $conn;
    private $products;
    function __construct()
    {
        $conn = new DB();
        $this->conn = $conn->getConn();
        $sql = $this->conn->prepare("SELECT * 
            FROM products
        ");

        $sql->execute();
        $this->products = $sql->fetchAll();
    }
    function setRow()
    {
    }
    function getAllRows()
    {

        return $this->products;
    }
    function updateRows()
    {
    }
    function deleteRows()
    {
    }
}