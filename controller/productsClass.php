<?php
include_once  'connection.php';
include_once  'DBInterface.php';
class Products extends Connection implements CRUDInterface
{
    private $conn;
    private $products;
    function __construct()
    {
        $this->conn = $this->connecton();
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