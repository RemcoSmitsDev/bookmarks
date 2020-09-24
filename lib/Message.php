<?php

class Message
{
    public function CreateSessionMessage($type, $message){
        $content = array('type' => 'Successfully ' . $type . '!!', 'message' => $message);
        setcookie("message", json_encode($content), time() + 1, "/");
    }
    public function RemoveSessionMessage(){
        unset($_COOKIE['message']);
        setcookie('message', null, -1);
    }
}