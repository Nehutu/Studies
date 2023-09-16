<?php

class User {
    private $name;
    private $surname;
    private $email;
    private $id;

    function __construct($id, $name, $surname, $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
    }

    function getId() {
        return $this->id;
    }
    function getName() {
        return $this->name;
    }
    function getSurname() {
        return $this->surname;
    }
    function getEmail() {
        return $this->email;
    }

    static function addUser($name, $surname, $email, $pass) {
        global $mysqli;
        
        $email = mb_strtolower(trim($email));
        $pass = trim($pass);
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
        if ($result->num_rows != 0) {
            return json_encode(["result"=>"exist"]);
        } else {
            $mysqli->query("INSERT INTO `users`(`name`, `surname`, `email`, `pass`) VALUES ('$name', '$surname', '$email', '$pass')");
            return json_encode(["result"=>"success"]);
        }
    }
    static function authUser($email, $pass) {
        global $mysqli;
        $email = trim(mb_strtolower($_POST["email"]));
        $pass = trim($_POST["pass"]);
        $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");

        $result = $result->fetch_assoc();

    if (password_verify($pass, $result["pass"])) {
        return json_encode(["result"=>"approved"]);
        $_SESSION["id"] = $result["id"];
        $_SESSION["name"] = $result["name"];
        $_SESSION["surname"] = $result["surname"];
        $_SESSION["email"] = $result["email"];
        } else {
        return json_encode(["result"=>"denied"]);
    }
    }
}