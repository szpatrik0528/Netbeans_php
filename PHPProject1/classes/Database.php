<?php

class Database {

    private $db = null;

    public function __construct($host, $user, $pass, $db) {
        $this->db = new mysqli($host, $user, $pass, $db);
    }

    public function login($email, $name, $pass) {
    $stmt = $this->db->prepare('SELECT `userid`, `emailcim`, `username`, `password` FROM `users` WHERE username = ? and emailcim = ? and password = ?');
    $stmt->bind_param("sss", $name, $email, $pass);
    if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $_SESSION['login'] = true;
            header("Location: index.php");
        }
    }
    $stmt->close();
}


    public function register($igazolvanyszam, $orokbefogado_neve, $email, $name, $pass1) {
        $stmt = $this->db->prepare("INSERT INTO `users`(`userid`, `igazolvanyszam`, `orokbefogado_neve`, `emailcim`, `username`, `password`) VALUES (NULL,?,?,?,?,?)");

        if (!$stmt) {
            die('Error: ' . $this->db->error);
        }

        $stmt->bind_param("sssss", $igazolvanyszam, $orokbefogado_neve, $email, $name, $pass1);

        try {
            if ($stmt->execute()) {
                $_SESSION['login'] = true;
                header("location: index.php");
            }
        } catch (Exception $e) {

            echo 'Error: ' . $e->getMessage();
        }
    }
    
    function osszesAllat(){
        $result = $this->db->query("SELECT * FROM allat");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    function kivalasztottAllat($id){
        $result = $this->db->query("SELECT * FROM `allat` WHERE allatid=".$id);
        return $result->fetch_assoc();
    }
}