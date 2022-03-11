<?php 
    include_once  'connection.php' ;
    include_once  'DBInterface.php' ;
    class Products extends Connection implements CRUDInterface {
        public $conn ;
        function __construct()
        {
            $this->conn = $this->connecton();
        }
        function setRow(){}
        function getAllRows(){
            $sql = $this->conn->prepare("SELECT * 
               FROM products
           ");

           $sql->execute();
           $rows = $sql->fetchAll();
           return $rows;
        }
        function updateRows(){}
        function deleteRows(){}
    }