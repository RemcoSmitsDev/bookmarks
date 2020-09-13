<?php
require_once "./config/init.php";
$login =  new Login();
$error = "";
if(isset($_SESSION['_user'])){
    header("location: ./bladwijzer.php");
}
if(isset($_COOKIE['email'], $_COOKIE['token']) && !empty($_COOKIE['email'] && $_COOKIE['token']) &&  empty($_SESSION['_user'])){
    if($user = $login->checkToken($_COOKIE['email'], $_COOKIE['token'])){
        if($login->HandleLogin($user->email, $user->password)){
            header("location: ./bladwijzer.php");
        }
    }
}
if(isset($_POST['email'], $_POST['password']) && $_POST['email'] !== "" && $_POST['password'] !== ""){
    if($login->HandleLogin($_POST['email'], $_POST['password'])){
        setcookie("email", $_POST['email'], time()+3600);
        setcookie("token", $login->createToken(), time()+3600);
        header("location: ./bladwijzer.php");
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
    <title>Login - Bookmarks</title>
</head>
<body class="flex items-center justify-center h-screen w-full antialiased">
<div class="px-4 space-y-6 container mx-auto max-w-lg">
    <h1 class="font-bold text-center text-3xl">Login</h1>
    <?php if($error !== ""): ?>
    <h2 class="text-red-500"><?= $error ?></h2>
    <?php endif; ?>
    <form class="w-full flex flex-col space-y-4" action="login.php" method="POST">
        <input class="px-4 py-2 border outline-none rounded" type="text" name="email" placeholder="Email" value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email']; } ?>" required>
        <input class="px-4 py-2 border outline-none rounded" type="password" name="password" placeholder="Password" value="" required>
        <button class="px-4 py-2 rounded font-semibold" type="submit">Log In</button>
    </form>
</div>

</body>
</html>