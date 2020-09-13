<?php
require_once './config/init.php';
$bladwijzer = new Bladwijzers();
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
