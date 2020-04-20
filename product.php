<?php
    class Product
    {
        private $pk;
        private $name;
        private $price;
        private $vat;
        private $price_vat;
        private $price_total;
        private $quantity;

        public function __construct($pk,$name,$price,$vat,$price_vat,$price_total,$quantity){
            $this->pk = $pk;
            $this->name = $name;
            $this->price = $price;
            $this->vat = $vat;
            $this->price_vat = $price_vat;
            $this->price_total = $price_total;
            $this->quantity = $quantity;
        }

        public function __get($property){
            if ('pk' === $property){
                return $this->pk;
            }
            else if ('name' === $property){
                return $this->name;
            }
            else if ('price' === $property){
                return $this->price;
            }
            else if ('vat' === $property){
                return $this->vat;
            }
            else if ('price_vat' === $property){
                return $this->price_vat;
            }
            else if ('price_total' === $property){
                return $this->price_total;
            }
            else if ('quantity' === $property){
                return $this->quantity;
            }
            else {
                throw new Exception('Propriété invalide !');
            }
        }

        public function __set($property,$value){
            if ('name' === $property){
                $this->name = $value;
            }
            else if ('price' === $property){
                $this->price = $value;
            }
            else if ('vat' === $property){
                $this->vat = $value;
            }
            else if ('price_vat' === $property){
                $this->price_vat = $value;
            }
            else if ('price_total' === $property){
                $this->price_total = $value;
            }
            else if ('quantity' === $property){
                $this->quantity = $value;
            }
            else {
                throw new Exception('Propriété invalide !');
            }
        }

    }
?>