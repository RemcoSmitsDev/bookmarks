<?php
require_once "./config/init.php";
$login =  new Login();
$bladwijzers = new Bladwijzers();

if (isset($_POST['email'], $_POST['password']) && $_POST['email'] !== "" && $_POST['password'] !== "") {
    if ($login->handleWebhookLogin($_POST['email'], $_POST['password'])) {
        echo json_encode($login->CheckIfUserExist($_POST['email']));
    } else {
        $error = "couldn't find a user with your email and password!";
        echo json_encode($error);
    }
}

if (isset($_GET['categories'], $_GET['user_id']) && $_GET['user_id'] !== '') {
    if ($cats = $bladwijzers->getCategoriesForWebhook($_GET['user_id'])) {
        echo json_encode($cats);
    }
}

if (isset($_POST['title'], $_POST['url'], $_POST['cat_id'], $_POST['user_id'])) {
    echo $bladwijzers->insertNewWithWebhook($_POST['title'], $_POST['url'], $_POST['cat_id'], $_POST['user_id']);
}