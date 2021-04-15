<?php

include_once 'Database.php';

/*
 * Handles operation on basic users
 */
class UserModel{

    private $db;

    /**
     * UserModel constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    public function createBasicUser($arr, $pass){
        try{
            $conn = $this->db->getConnection();

            $prep = $conn->prepare("INSERT INTO users (email, password, secret, first_name, surname) VALUES (:email,:password, :secret, :first_name, :surname)");
            $prep->bindParam(':email', $arr['email'], PDO::PARAM_STR);
            $prep->bindParam(':password', $pass, PDO::PARAM_STR);
            $prep->bindParam(':secret', $arr['secret'], PDO::PARAM_STR);
            $prep->bindParam(':first_name', $arr['first_name'], PDO::PARAM_STR);
            $prep->bindParam(':surname', $arr['surname'], PDO::PARAM_STR);

            return ($prep->execute()) ? "Úspešne pridaný nový používatel" : "Niečo sa nepodarilo";

        } catch(PDOException $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }

    public function getUserInfo($email)
    {
        $conn = $this->db->getConnection();
        $sth = $conn->prepare('SELECT email, first_name, surname FROM users WHERE email=:email');
        $sth->bindParam(':email', $email, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function verifyUserPass($email, $hashedPass)
    {
        $conn = $this->db->getConnection();
        $sth = $conn->prepare('SELECT password FROM users WHERE email=:email');
        $sth->bindParam(':email', $email, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if ($result != null && strcmp($hashedPass, $result['password'] ) == 0){ // if pass is correct, also audit login
            $prep = $conn->prepare("INSERT INTO login_audit (user_email, login_type) VALUES (?,'BASIC')");
            return $prep->execute([$email]);
        }
        return false;
    }


    public function getUserSecret($email)
    {
        $conn = $this->db->getConnection();
        $sth = $conn->prepare('SELECT secret FROM users WHERE email=?');
        $sth->execute([$email]);
        return $sth->fetchColumn();
    }

}