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

    public function startCookie(){
        if(!isset($_COOKIE['email'], $_COOKIE['token'])){
            setcookie("email", $_SESSION['_user']->email, time() + (10 * 365 * 24 * 60 * 60), "/");
            setcookie("token", $this->createToken(), time() + (10 * 365 * 24 * 60 * 60), "/");
        }else{
            setcookie("email", $_SESSION['_user']->email, time() + (10 * 365 * 24 * 60 * 60), "/");
            setcookie("token", $_SESSION['_user']->token, time() + (10 * 365 * 24 * 60 * 60), "/");
        }
    }

    public function HandleLogin($email, $password){
        if(!isset($_SESSION['_user'])){
            if($user = $this->CheckIfUserExist($email, md5($password))){
                $_SESSION['_user'] = $user;
                $this->startCookie();
                return $user;
            }else{
                return false;
            }
        }
    }
    public function HandleTokenLogin($email, $token){
        if(!isset($_SESSION['_user'])){
            if($user = $this->CheckIfUserExistWithToken($email, $token)){
                $_SESSION['_user'] = $user;
                $this->startCookie();
                return $user;
            }else{
                return false;
            }
        }
    }

    public function CheckIfUserExistWithToken($email, $token){
        $this->db->query("SELECT id, first_name, last_name, email, token FROM users WHERE email = :email AND token = :token LIMIT 1");
        $this->db->bind(":email", $email);
        $this->db->bind(":token", $token);
        return $this->db->single();
    }

    public function CheckIfUserExist($email){
        $this->db->query("SELECT id, first_name, last_name, email, token FROM users WHERE email = :email LIMIT 1");
        $this->db->bind(":email", $email);
        return $this->db->single();
    }

    public function CreateUser($first_name, $last_name, $email, $password){
        if($this->CheckIfUserExist($email)){
            return false;
        }
        $this->db->query("INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)");
        $this->db->bind(":first_name", $first_name);
        $this->db->bind(":last_name", $last_name);
        $this->db->bind(":email", $email);
        $this->db->bind(":password",  md5($password));
        $this->db->execute();
        return true;
    }
    public function logout(){
        unset($_COOKIE['email']);
        unset($_COOKIE['token']);
        setcookie('email', null, -1);
        setcookie('token', null, -1);
        session_destroy();
        header("location: ./");
    }
}