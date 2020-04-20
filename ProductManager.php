<?php
//dao = data acces object
//dal = data access layer
class ProductManager {
    private $table;
    private $connection;
    private $product_list;
    
    function __construct() {
        $this->table = 'products';
        $this->connection = new PDO('mysql:host=localhost;dbname=demo', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $this->product_list = array();
    }
    
    function save($data) {
        $data['pk'] = -1;
        $product = $this->create([
            'pk' => $data['pk'],
            'name' => $data['name'],
            'price' =>$data['price'],
            'vat' => 0,
            'price_vat' => 0, 
            'price_total' => 0,
            'quantity' => $data['quantity']
        ]);
        
        if ($product) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (name, price, vat, price_vat, price_total, quantity) VALUES (?, ?, ?, ?, ?, ?)"
                );
                $statement->execute([
                    $product->__get('name'),
                    $product->__get('price'),
                    $product->__get('vat'),
                    $product->__get('price_vat'),
                    $product->__get('price_total'),
                    $product->__get('quantity')
                ]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        } 
    }
    
    function fetchAll() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($results as $product) {
                array_push($this->product_list, $this->create($product));
            }
            return $this->product_list;
            
        } catch (PDOException $e) {
            print $e->getMessage();
        }    
    }
    
    function fetch($pk) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE pk = ?");
            $statement->execute([$pk]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            
            return $this->create($result);
            
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
    
    function create($data) {
        return new Product(
            $data['pk'],
            $data['name'],
            $data['price'],
            $data['vat'],
            $data['price_vat'],
            $data['price_total'],
            $data['quantity']
        );
    }
    
    function __get($property) {
        if (property_exists($this, $property)) {
			return $this->$property;
		}
    }
    
    function __set($property, $value) {
        if (property_exists($this, $property)) {
			$this->$property = $value;
		}
    }

    function delete($pk){
        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE pk = ?");
            $statement->execute([$pk]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    function update($name,$price,$quantity,$pk){
        $statement = $this->connection->prepare("UPDATE products SET name = ?, price = ?, quantity = ? WHERE pk = ?");
        $statement->execute(([$name,$price,$quantity,$pk]));
    }

    function calc_Total($price,$vat){
        $totalPrice = $price + ($price*($vat/100));
        return ($totalPrice);
    }

    function calc_VatValue($price,$vat){
        $vatValue = $price*($vat*100);
        return ($vatValue);
    }
}
