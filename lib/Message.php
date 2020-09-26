<?php

class Message
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function CreateSessionMessage($type, $message = ''){
        $content = array('type' => 'Successfully ' . $type . '!', 'message' => $message);
        setcookie("message", json_encode($content), time() + 1, "/");
        $this->addUpdate($type);
    }

    public function getUpdates(){
        $this->db->query("SELECT * FROM updates WHERE user_id = :user_id ORDER BY id DESC");
        $this->db->bind(":user_id", $_SESSION['_user']->id);
        return $this->db->resultSet();
    }

    public function addUpdate($message){
        $this->db->query("INSERT INTO updates (user_id, message) VALUES (:user_id, :message)");
        $this->db->bind(":user_id", $_SESSION['_user']->id);
        $this->db->bind(":message", $message);
        $this->db->execute();
    }
}