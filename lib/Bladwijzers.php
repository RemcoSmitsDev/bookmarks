<?php
class Bladwijzers
{
    private $db;
    public $message;

    public function __construct()
    {
        $this->db = new Database();
        $this->message = new Message();
    }

    public function GetItemsByCat($id)
    {
        $this->db->query("SELECT * FROM items Where cat_id = :id AND user_id  = :user_id");
        $this->db->bind(":id", $id);
        $this->db->bind(":user_id", $_SESSION['_user']->id);
        return $this->db->resultSet();
    }
    public function GetAllCats()
    {
        $this->db->query("SELECT * FROM categorie WHERE user_id = :user_id");
        $this->db->bind(":user_id", $_SESSION['_user']->id);
        return $this->db->resultSet();
    }
    public function insertNew($title, $url, $cat_id)
    {
        $this->db->query("INSERT INTO items (title, url, cat_id, user_id) values (:title, :url, :cat_id, :user_id)");
        $this->db->bind(":title", $title);
        $this->db->bind(":url", $url);
        $this->db->bind(":cat_id", $cat_id);
        $this->db->bind(":user_id", $_SESSION['_user']->id);
        $this->db->execute();
        $this->message->CreateSessionMessage('Added <b class="extrabold">' . $title . '</b> as bookmark', '');
    }
    public function removeItem($id){
        $bookmark = $this->getItem($id);
        $this->db->query("DELETE FROM items WHERE id = :id AND user_id = :user_id");
        $this->db->bind(":id", $id);
        $this->db->bind(":user_id", $_SESSION['_user']->id);
        $this->db->execute();
        $this->message->CreateSessionMessage('removed bookmark <b class="font-extrabold">' . $bookmark->title . '</b>', '');
    }
    public function addCat($cat){
        $this->db->query("INSERT INTO categorie (name, user_id) values (:cat, :user_id)");
        $this->db->bind(":cat", $cat);
        $this->db->bind(":user_id", $_SESSION['_user']->id);
        $this->db->execute();
        $this->message->CreateSessionMessage('added <b class="extrbold">' . $cat . '</b> as category', 'You can now add bookmarks with the category: <b class="font-extrabold">' . $cat . '</b>');
    }
    public function getItem($id){
        $this->db->query("SELECT * FROM items WHERE id = :id AND user_id = :user_id");
        $this->db->bind(":id", $id);
        $this->db->bind(":user_id", $_SESSION['_user']->id);
        return $this->db->single();
    }

    public function updateItem($editId, $title, $url, $cat_id){
        $this->db->query("UPDATE items set title = :title, cat_id = :cat_id, url = :url WHERE id = :edit_id AND user_id = :user_id");
        $this->db->bind(":title", $title);
        $this->db->bind(":cat_id", $cat_id);
        $this->db->bind(":url", $url);
        $this->db->bind(":edit_id", $editId);
        $this->db->bind(":user_id", $_SESSION['_user']->id);
        $this->db->execute();
        $this->message->CreateSessionMessage('updated <b class="font-extrabold">' . $title . '</b>', '');
    }

}