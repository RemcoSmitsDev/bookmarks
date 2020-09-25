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
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script defer async src="https://www.googletagmanager.com/gtag/js?id=UA-178297120-2"></script>
    <script defer>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-178297120-2');
    </script>

    <meta charset="UTF-8">
    <link rel="shortcut icon" href="./images/logo.svg">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="all" href="./css/tailwindcss.css">
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
<div class="absolute w-full pointer-events-none" style="z-index:-1; background: linear-gradient(90deg, #0072ff 0%, #00d4ff 100%); clip-path: polygon(100% 0, 100% 23%, 0 58%, 0 0); height: 20rem;">
</div>
<nav id="nav" class="relative py-6 px-4 w-full md:flex md:items-center md:justify-between container mx-auto max-w-screen-xl z-auto" >
    <a class="inline-flex space-x-1 items-center text-3xl font-semibold transform hover:scale-110 text-white" href="./"><svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg><span>Bookmarks</span></a>
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