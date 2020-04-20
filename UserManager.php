<?php
class UserManager {
    private $table;
    private $connection;
    private $user_list;

    function __construct(){
        $this->table = 'users';
        $this->connection = new PDO('mysql:host=localhost;dbname=demo', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->user_list = array();
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

    function create($data) {
        return new User(
        $data['pk'],
        $data['username'],
        $data['password'],
        $data['created_at'],
        $data['updated_at']
    );
    }

    function delete($pk){
        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE pk = ?");
            $statement->execute([$pk]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    function update($username,$password,$pk){
        $statement = $this->connection->prepare("UPDATE users SET username = ?, password = ? WHERE pk = ?");
        $statement->execute(([$username,$password,$pk]));
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
}
?>