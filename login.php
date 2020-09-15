<?php
require_once "./config/init.php";
$login =  new Login();
$error = "";
if(isset($_SESSION['_user'])){
    header("location: "  .$_SESSION['_user']->first_name. "-".$_SESSION['_user']->last_name);
}
if(isset($_COOKIE['email'], $_COOKIE['token']) && !empty($_COOKIE['email'] && $_COOKIE['token']) &&  empty($_SESSION['_user'])){
    if($login->checkToken($_COOKIE['email'], $_COOKIE['token'])){
        if($login->HandleTokenLogin($_COOKIE['email'], $_COOKIE['token'])){
            header("location: ". $_SESSION['_user']->first_name. "-".$_SESSION['_user']->last_name);
        }
    }
}
if(isset($_POST['email'], $_POST['password']) && $_POST['email'] !== "" && $_POST['password'] !== ""){
    if($login->HandleLogin($_POST['email'], $_POST['password'])){
        header("location: " . $_SESSION['_user']->first_name. "-".$_SESSION['_user']->last_name);
    }else{
        $error = "couldn't find a user with your email and password!";
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
    <meta property="og:title" content="Login - All your bookmarks in one place">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Login - All your bookmarks in one place">
    <meta property="og:image" content="https://bladwijzers.rswebdevelopment.nl/images/banner.png">
    <meta property="og:url" content="https://bladwijzers.rswebdevelopment.nl/login" />
    <meta name="description" content="All your bookmarks in one place. Easy to use bookmarks system.">
    <meta name="keywords"
          content="Bookmarks, bladwijzers, start.io, bladwijzer, bookmarks system, bookmarks on startpage, login, sign in, sign up">
    <title>Login - All your bookmarks in one place</title>
</head>
<body class="antialiased">
<div class="absolute w-full" style="z-index:-1; background: linear-gradient(90deg, #0072ff 0%, #00d4ff 100%); clip-path: polygon(100% 0, 100% 23%, 0 58%, 0 0); height: 30rem;">
</div>
<nav id="nav" class="relative py-6 px-4 w-full md:flex md:items-center md:justify-between container mx-auto max-w-screen-xl z-auto" >
    <a class="text-3xl font-semibold transform hover:scale-110 text-white" href="./">Bookmarks</a>
</nav>
<section class="px-4 mt-32 md:mt-56 space-y-6 container mx-auto max-w-lg">
    <h1 class="font-bold text-center text-4xl">Login</h1>
    <?php if($error !== ""): ?>
    <h2 class="text-red-500 text-center"><?= $error ?></h2>
    <?php endif; ?>
    <form class="flex flex-col space-y-4" action="login" method="POST">
        <input class="px-4 py-2 border outline-none rounded appearance-none" type="text" name="email" placeholder="Email" value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email']; } ?>" required>
        <input class="px-4 py-2 border outline-none rounded appearance-none" type="password" name="password" placeholder="Password" value="" required>
        <button class="px-4 py-2 rounded font-semibold" type="submit">Log In</button>
        <a class="text-sm leading-relaxed text-center" href="register">If you don't have an account!? Make one now</a>
    </form>
</section>

</body>
</html>