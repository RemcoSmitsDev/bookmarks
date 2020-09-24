<?php
require_once './config/init.php';
$bladwijzer = new Bladwijzers();
$messages = new Message();
if (isset($_POST['title'], $_POST['url'], $_POST['cat_id'])) {
    $bladwijzer->insertNew($_POST['title'], $_POST['url'], $_POST['cat_id']);
    return json_encode("error");
}

if(isset($_POST['id'])){
    $bladwijzer->removeItem($_POST['id']);
}

if(isset($_POST['cat'])){
    $bladwijzer->addCat($_POST['cat']);
}

if(isset($_GET['editId'])){
    echo json_encode($bladwijzer->getItem($_GET['editId']));
}

if(isset($_POST['editId'], $_POST['edit_title'], $_POST['edit_url'], $_POST['edit_cat_id'])){
    $bladwijzer->updateItem($_POST['editId'], $_POST['edit_title'], $_POST['edit_url'], $_POST['edit_cat_id']);
}
