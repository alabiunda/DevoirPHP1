<?php
class User {
    private $pk;
    private $username;
    private $password;
    private $created_at;
    private $updated_at;

    function __construct($pk,$username,$password,$created_at,$updated_at){
        $this->pk=$pk;
        $this->username=$username;
        $this->password=$password;
        $this->created_at=$created_at;
        $this->updated_at=$updated_at;
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
}
?>