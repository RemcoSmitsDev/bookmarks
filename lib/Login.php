<?php
class Login{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }
    public function checkToken($email, $token){
            $this->db->query("SELECT * FROM users WHERE token = :token AND email = :email LIMIT 1");
            $this->db->bind(":token", $token);
            $this->db->bind(":email", $email);
            return $this->db->single();
    }
    public function createToken(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randstring = '';
        $stringlengte = strlen($characters);
        for ($i = 0; $i < 20; $i++) {
            $randstring .= $characters[rand(0, $stringlengte - 1)];
        }
        $this->db->query("UPDATE users set token = :token WHERE email = :email");
        $this->db->bind(":token", $randstring);
        $this->db->bind(":email", $_SESSION['_user']->email);
        $this->db->execute();
        return $randstring;
    }


    public function HandleLogin($email, $password){
        if(!isset($_SESSION['_user'])){
            if($this->CheckIfUserExist($email, $password)){
                $_SESSION['_user'] = $this->CheckIfUserExist($email, $password);
                return true;
            }else{
                return false;
            }
        }
    }

    public function CheckIfUserExist($email,$password){
        $this->db->query("SELECT id, first_name, last_name, email, password FROM users WHERE email = :email LIMIT 1");
        $this->db->bind(":email", $email);
        return $this->db->single();
    }

    public function CreateUser($first_name, $last_name, $email, $password){
        $this->db->query("INSERT INTO users (first_name, last_name, password) VALUES (:first_name, :last_name, :email, :password)");
        $this->db->bind(":first_name", $first_name);
        $this->db->bind(":last_name", $last_name);
        $this->db->bind(":email", $email);
        $this->db->bind(":password",  md5($password));
        if(!$this->CheckIfUserExist($email)){
            $this->db->execute();
        }
    }
}