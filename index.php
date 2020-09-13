<?php
require_once "./config/init.php";
$login = new Login();
if(isset($_COOKIE['email'], $_COOKIE['token']) && !empty($_COOKIE['email'] && $_COOKIE['token']) && empty($_SESSION['_user'])){
    if($user = $login->checkToken($_COOKIE['email'], $_COOKIE['token'])){
        if($login->HandleLogin($user->email, $user->password)){
            header("resfresh:0;");
        }
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
    <title>Home - Bookmarks</title>
</head>
<body class="antialiased">
<div class="absolute w-full" style="z-index:-1; background: linear-gradient(90deg, #0072ff 0%, #00d4ff 100%); clip-path: polygon(100% 0, 100% 23%, 0 58%, 0 0); height: 30rem;">
</div>
<nav id="header" class="py-6 px-4 flex justify-between container mx-auto max-w-screen-xl z-auto" >
    <a class="text-3xl font-semibold transform hover:scale-110 text-white" href="">Bookmarks</a>
    <?php if(!isset($_SESSION['_user'])):  ?>
    <div class="space-x-4">
        <a class="px-4 py-2 inline-flex items-center rounded bg-green-400 text-white font-semibold transform hover:scale-110" href="login.php">Login</a>
        <a class="px-4 py-2 inline-flex items-center rounded border border-bg-green-400 font-semibold transform hover:scale-110" href="register.php">register</a>
    </div>
    <?php else: ?>
    <a class="group px-4 py-2 inline-flex items-center rounded bg-white bg-opacity-25 text-white font-semibold transform hover:scale-110" href="bladwijzer.php">Go to your bookmarks
        <span class="mt-px">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
        </span>
    </a>
    <?php endif; ?>
</nav>
<section id="banner" class="px-6 mt-32 flex items-center justify-center w-full z-10">
    <div>
        <h1 class="leading-tight font-bold text-6xl">Bookmarks</h1>
        <h1 class="leading-tight font-bold text-6xl">dasboard</h1>
        <h1 class="leading-tight font-bold text-6xl">for all your websites</h1>
    </div>
    <div>
        <img class="h-auto w-full md:max-w-3xl" src="./images/banner.svg" alt="">
    </div>
</section>
<section id="main" class="px-4 mt-20 space-y-10 container mx-auto max-w-screen-xl">
    <div id="info-1" class="relative mx-auto md:ml-0 p-6 space-y-2 rounded-lg shadow max-w-md transform hover:scale-105 transistion-scale duration-500">
        <span class="-ml-2 -mt-2 h-6 w-6 absolute top-0 left-0 px-2 inline-flex items-center justify-center rounded-full bg-indigo-600 text-white font-semibold">1</span>
        <h2 class="font-semibold text-2xl">Create a account</h2>
        <p class="leading-relaxed">To create an account it's very easy and fast. You only have to pass in 3 fields and you are done.</p>
    </div>
    <div id="info-1" class="relative md:ml-auto md:mr-0 mx-auto p-6 space-y-2 rounded-lg shadow max-w-md transform hover:scale-105 transistion-scale duration-500">
        <span class="-ml-2 -mt-2 h-6 w-6 absolute top-0 left-0 px-2 inline-flex items-center justify-center rounded-full bg-indigo-600 text-white font-semibold">2</span>
        <h2 class="font-semibold text-2xl">Add some categories</h2>
        <p class="leading-relaxed">You can really easy add categories.</p>
    </div>
    <div id="info-1" class="relative mx-auto md:ml-0 p-6 space-y-2 rounded-lg shadow max-w-md transform hover:scale-105 transistion-scale duration-500">
        <span class="-ml-2 -mt-2 h-6 w-6 absolute top-0 left-0 px-2 inline-flex items-center justify-center rounded-full bg-indigo-600 text-white font-semibold">3</span>
        <h2 class="font-semibold text-2xl">Add some items</h2>
        <p class="leading-relaxed">If you have made some categories, you can add bookmarks for each category.</p>
    </div>
</section>
<footer id="footer" class="mt-20">
    <div class="px-4 container mx-auto max-w-screen-xl">
        <h1>test</h1>
    </div>
</footer>

</body>
</html>