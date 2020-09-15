<?php
require_once "./config/init.php";
$register = new Login();
if(isset($_SESSION['_user'])){
    header("location: " .$_SESSION['_user']->first_name. "-".$_SESSION['_user']->last_name);
}
$error = "";
if(isset($_COOKIE['email'], $_COOKIE['token']) && !empty($_COOKIE['email'] && $_COOKIE['token']) &&  empty($_SESSION['_user'])){
    if($register->checkToken($_COOKIE['email'], $_COOKIE['token'])){
        if($register->HandleTokenLogin($_COOKIE['email'], $_COOKIE['token'])){
            header("location: ". $_SESSION['_user']->first_name. "-".$_SESSION['_user']->last_name);
        }
    }
}
if(isset($_POST['first_name'],$_POST['last_name'], $_POST['email'],$_POST['password'])){
    if($register->CreateUser($_POST['first_name'],$_POST['last_name'], $_POST['email'],$_POST['password'])){
        if($register->HandleLogin($_POST['email'], $_POST['password'])){
            header("location: ".$_SESSION['_user']->first_name. "-".$_SESSION['_user']->last_name);
        }
    }else{
        $error = "User already exist with you email!";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/tailwindcss.css">
    <meta property="og:description" content="All your bookmarks in one place">
    <meta property="og:title" content="Create an account - All your bookmarks in one place">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Create an account - All your bookmarks in one place">
    <meta property="og:image" content="https://bladwijzers.rswebdevelopment.nl/images/banner.png">
    <meta property="og:url" content="https://bladwijzers.rswebdevelopment.nl/register" />
    <meta name="description" content="All your bookmarks in one place. Easy to use bookmarks system.">
    <meta name="keywords"
          content="Bookmarks, bladwijzers, start.io, bladwijzer, bookmarks system, bookmarks on startpage, login, sign in, sign up, create an account, register">
    <title>Create an account - All your bookmarks in one place</title>
</head>
<body class="antialiased">
<div class="absolute w-full" style="z-index:-1; background: linear-gradient(90deg, #0072ff 0%, #00d4ff 100%); clip-path: polygon(100% 0, 100% 23%, 0 58%, 0 0); height: 30rem;">
</div>
<nav id="nav" class="relative py-6 px-4 w-full md:flex md:items-center md:justify-between container mx-auto max-w-screen-xl z-auto" >
    <a class="text-3xl font-semibold transform hover:scale-110 text-white" href="./">Bookmarks</a>
</nav>
<section class="space-y-6 px-4 mt-32 md:mt-56 container mx-auto max-w-lg">
    <h2 class="font-bold text-4xl text-center">Create an account</h2>
    <?php if($error !== ""): ?>
        <h2 class="text-red-500 text-center"><?= $error ?></h2>
    <?php endif; ?>
    <form class="space-y-4 flex flex-col" action="register" method="post">
        <input class="px-4 py-2 border outline-none rounded appearance-none" type="text" name="first_name" placeholder="First name" required>
        <input class="px-4 py-2 border outline-none rounded appearance-none" type="text" name="last_name" placeholder="Last name" required>
        <input class="px-4 py-2 border outline-none rounded appearance-none" type="text" name="email" placeholder="Email" required>
        <input class="px-4 py-2 border outline-none rounded appearance-none" type="password" name="password" placeholder="Password" required>
        <button class="px-4 py-2 rounded font-semibold" type="submit">Create your account</button>
        <a class="text-sm leading-relaxed text-center" href="login">You already have an account!? Log in</a>
    </form>
</section>
</body>
</html>