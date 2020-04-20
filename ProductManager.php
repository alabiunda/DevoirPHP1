<?php
    class ProductManager{
        private $results = array();
        private $conndb;

        public function __construct($host,$dbname,$id,$pw){
            $this->conndb = new PDO('mysql:'.$host.';dbname='.$dbname,$id,$pw);
        }
    }
?>