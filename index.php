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
    <link rel="stylesheet" type="text/css" media="all" href="./css/tailwindcss.css" >
    <meta property="og:description" content="All your bookmarks in one place">
    <meta property="og:title" content="Homepage - All your bookmarks in one place">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Homepage - All your bookmarks in one place">
    <meta property="og:image" content="https://bladwijzers.rswebdevelopment.nl/images/banner.png">
    <meta property="og:url" content="https://bladwijzers.rswebdevelopment.nl/" />
    <meta name="description" content="All your bookmarks in one place. Easy to use bookmarks system.">
    <meta name="keywords"
          content="Bookmarks, bladwijzers, start.io, bladwijzer, bookmarks system, bookmarks on startpage">
    <title>Home - All your bookmarks in one place</title>
</head>
<body class="antialiased overflow-x-hidden">
<div class="absolute w-full pointer-events-none" style="z-index:-1; background: linear-gradient(90deg, #0072ff 0%, #00d4ff 100%); clip-path: polygon(100% 0, 100% 23%, 0 58%, 0 0); height: 20rem;">
</div>
<nav id="nav" class="relative py-6 px-4 w-full flex items-center justify-between container mx-auto max-w-screen-xl z-auto" >
    <a class="inline-flex space-x-1 items-center text-3xl font-semibold transform hover:scale-110 text-white" href="./"><svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg><span>Bookmarks</span></a>
    <div class="hidden md:block">
    <?php if(!isset($_SESSION['_user'])):  ?>
    <div class="space-x-4">
        <a class="px-4 py-2 inline-flex items-center rounded bg-white bg-opacity-25 text-white font-semibold transform hover:scale-110 focus:outline-none" href="login">Login</a>
        <a class="px-4 py-2 inline-flex items-center rounded border border-bg-green-400 text-white font-semibold transform hover:scale-110 focus:outline-none" href="register">Create an account</a>
    </div>
    <?php else: ?>
    <a class="group px-4 py-2 inline-flex items-center rounded bg-white bg-opacity-25 text-white font-semibold transform hover:scale-110 focus:outline-none" href="<?= $_SESSION['_user']->first_name. "-".$_SESSION['_user']->last_name ?>">Go to your bookmarks
        <span class="mt-px">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
        </span>
    </a>
    <?php endif; ?>
    </div>
    <button id="toggleMenu" class="h-8 w-8 inline-flex items-center justify-center md:hidden rounded bg-white bg-opacity-25 focus:outline-none">
        <svg class="flex-shrink-0 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
        </svg>
    </button>
</nav>
<div id="menu" class="hidden opacity-0 transition-all duration-1000 p-4 fixed inset-x-0 inset-y-0 z-20">
    <div class="p-4 bg-white h-full w-full rounded shadow-lg">
        <div class="flex justify-end">
        <button id="closeMenu" class="focus:outline-none">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
        </div>
        <div class="mt-20 space-x-6 flex items-center justify-center">
            <?php if(!isset($_SESSION['_user'])):  ?>
        <a class="px-4 py-2 inline-flex items-center rounded text-white font-semibold transform hover:scale-110 focus:outline-none" href="login" style="background: linear-gradient(90deg, #0072ff 0%, #00d4ff 100%);">Login</a>
        <a class="px-4 py-2 inline-flex items-center rounded border border-bg-green-400 font-semibold transform hover:scale-110 focus:outline-none" href="register">Create an account</a>
            <?php else: ?>
            <a class="px-4 py-2 inline-flex items-center rounded text-white font-semibold transform hover:scale-110 focus:outline-none" href="<?= $_SESSION['_user']->first_name. "-".$_SESSION['_user']->last_name ?>" style="background: linear-gradient(90deg, #0072ff 0%, #00d4ff 100%);">Go to your bookmarks
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
<section id="banner" class="mx-4 mt-16 md:mt-32 xl:space-x-20 space-y-16 xl:space-y-0 xl:flex-row flex-col flex items-center justify-center z-10">
    <div id="text" class="opacity-0">
        <h1 class="block leading-tight font-bold text-2xl sm:text-5xl text-gray-900">All your  <span class="leading-tight font-bold text-2xl sm:text-5xl text-5xl sm:text-6xl md:text-6xl text-gray-900">bookmarks</span></h1>
        <h1 class="block leading-tight font-bold text-3xl sm:text-5xl text-gray-900">in one place</h1>
    </div>
    <div id="banner-img" class="flex-shrink h-auto w-full max-w-2xl shadow-xl overflow-hidden opacity-0">
        <img src="./images/banner.png" alt="Picture of bookmarks page">
    </div>
</section>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- bookmarks -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-1783394865391064"
     data-ad-slot="4286787301"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<script defer src="./js/gsap.js"></script>
<script defer src="./js/jquery.js"></script>
<script defer src="./js/index.js">
</script>
</body>
</html>