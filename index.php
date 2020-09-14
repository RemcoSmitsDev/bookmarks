<?php
require_once "./config/init.php";
$login = new Login();
if(isset($_GET['logout'])){
    $login->logout();
}
if(isset($_COOKIE['email'], $_COOKIE['token']) && !empty($_COOKIE['email'] && $_COOKIE['token']) && empty($_SESSION['_user'])){
    if($login->checkToken($_COOKIE['email'], $_COOKIE['token'])){
        if($login->HandleTokenLogin($_COOKIE['email'], $_COOKIE['token'])){
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
<nav id="nav" class="relative py-6 px-4 w-full flex items-center justify-between container mx-auto max-w-screen-xl z-auto" >
    <a class="text-3xl font-semibold transform hover:scale-110 text-white" href="./">Bookmarks</a>
    <div class="hidden md:block">
    <?php if(!isset($_SESSION['_user'])):  ?>
    <div class="space-x-4">
        <a class="px-4 py-2 inline-flex items-center rounded bg-white bg-opacity-25 text-white font-semibold transform hover:scale-110" href="login.php">Login</a>
        <a class="px-4 py-2 inline-flex items-center rounded border border-bg-green-400 text-white font-semibold transform hover:scale-110" href="register.php">Create an account</a>
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
    </div>
    <button id="toggleMenu" class="h-8 w-8 inline-flex items-center justify-center md:hidden rounded bg-white bg-opacity-25">
        <svg class="flex-shrink-0 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
        </svg>
    </button>
</nav>
<div id="menu" class="hidden opacity-0 transition-all duration-1000 p-4 fixed inset-x-0 inset-y-0 z-20">
    <div class="p-4 bg-white h-full w-full rounded shadow-lg">
        <div class="flex justify-end">
        <button id="closeMenu">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
        </div>
        <div class="mt-20 space-x-6 flex items-center justify-center">
            <?php if(!isset($_SESSION['_user'])):  ?>
        <a class="px-4 py-2 inline-flex items-center rounded text-white font-semibold transform hover:scale-110" href="login.php" style="background: linear-gradient(90deg, #0072ff 0%, #00d4ff 100%);">Login</a>
        <a class="px-4 py-2 inline-flex items-center rounded border border-bg-green-400 font-semibold transform hover:scale-110" href="register.php">Create an account</a>
            <?php else: ?>
            <a class="px-4 py-2 inline-flex items-center rounded text-white font-semibold transform hover:scale-110" href="bladwijzer.php" style="background: linear-gradient(90deg, #0072ff 0%, #00d4ff 100%);">Go to your bookmarks
                <span class="mt-px">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
        </span>
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<section class="mx-4 mt-16 md:mt-32 xl:space-x-20 space-y-16 xl:space-y-0 xl:flex-row flex-col flex items-center justify-center z-10">
    <div>
        <h1 class="leading-tight font-bold text-5xl sm:text-6xl md:text-6xl text-gray-900"><span class="text-4xl sm:text-5xl">Your</span> bookmarks</h1>
        <h1 class="leading-tight font-bold text-4xl sm:text-5xl text-gray-900">at</h1>
        <h1 class="leading-tight font-bold text-4xl sm:text-5xl text-gray-900">one place</h1>
    </div>
    <div class="flex-shrink">
        <img class="h-auto w-full max-w-2xl shadow-xl" src="./images/banner.png" alt="">
    </div>
</section>
<?php if(!isset($_SESSION['_user'])): ?>
<section class="md:hidden px-6 my-48 container mx-auto max-w-screen-xl">
    <div class="border-l-2 space-y-20">
        <div id="info-1" class="-ml-3 space-x-2 flex items-center max-w-md">
            <span class="h-6 w-6 px-2 inline-flex items-center justify-center rounded-full text-white font-semibold" style="background: #00d4ff;">1</span>
            <a href="./register.php" class="font-semibold text-2xl">Create an account</a>
    <!--        <p class="leading-relaxed">To create an account it's very easy and fast. You only have to pass in 3 fields and you are done.</p>-->
        </div>
        <div id="info-2" class="-ml-3 space-x-2 flex items-center max-w-md">
            <span class="h-6 w-6 px-2 inline-flex items-center justify-center rounded-full text-white font-semibold" style="background: #00d4ff;">2</span>
            <h2 class="font-semibold text-2xl">Add categories</h2>
    <!--        <p class="leading-relaxed">You can really easy add categories.</p>-->
        </div>
        <div id="info-3" class="-ml-3 space-x-2 flex items-center max-w-md">
            <span class="h-6 w-6 px-2 inline-flex items-center justify-center rounded-full text-white font-semibold" style="background: #00d4ff;">3</span>
            <h2 class="font-semibold text-2xl">Add bookmark</h2>
    <!--        <p class="leading-relaxed">If you have made some categories, you can add bookmarks for each category.</p>-->
        </div>
    </div>
</section>
<?php endif; ?>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script type="text/javascript">
$("#toggleMenu").click((e) => {
    $("#menu").removeClass("hidden");
    $("#menu").removeClass("opacity-0");
    $("body").addClass("overflow-hidden");
});
$("#closeMenu").click((e) => {
    $("#menu").addClass("hidden");
    $("#menu").addClass("opacity-0");
    $("body").removeClass("overflow-hidden");
});
</script>
</body>
</html>