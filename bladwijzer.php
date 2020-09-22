<?php
require_once "./config/init.php";
$bladwijzers = new Bladwijzers();
$user = new Login();
$cats = $bladwijzers->GetAllCats();
if(!isset($_SESSION['_user'])){
    header("location: ./login.php");
    exit;
}
if(isset($_GET['logout'])){
    $user->logout();
}
//$slug = str_replace("/", "",$_SERVER['REQUEST_URI']);
//if($slug !== $_SESSION['_user']->first_name . "-" . $_SESSION['_user']->last_name){
//    header("location: ". $_SESSION['_user']->first_name . "-" . $_SESSION['_user']->last_name);
//}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="./images/logo.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bladwijzers - Your bookmarks at one place</title>
    <link rel="stylesheet" media="all" href="./css/tailwindcss.css">
</head>

<body class="antialiased">
<div class="absolute w-full hidden md:block pointer-events-none" style="z-index:-1; background: linear-gradient(90deg, #0072ff 0%, #00d4ff 100%); clip-path: polygon(100% 0, 100% 23%, 0 58%, 0 0); height: 20rem;">
</div>
<div class="absolute w-full md:hidden h-40 pointer-events-none" style="z-index:-1; background: linear-gradient(90deg, #0072ff 0%, #00d4ff 100%);">
</div>
<nav id="nav" class="relative py-6 px-4 w-full sm:flex sm:items-center sm:justify-between container mx-auto max-w-screen-xl z-auto" >
    <a class="inline-flex space-x-1 items-center text-3xl font-semibold transform hover:scale-110 text-white" href="./">
        <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg>
        <span>Bookmarks</span>
    </a>
    <div class="mt-4 md:mt-0 flex space-x-4">
        <?php if(count($cats) > 0):  ?>
            <div>
                <button id="showItemMenu" class="px-4 py-2 inline-flex items-center rounded bg-white bg-opacity-25 text-white font-semibold transform hover:scale-110">Create bookmark
                    <span class="mt-px">
                        <svg class="h-6 w-6 mt-px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </span>
                </button>
            </div>
        <?php endif; ?>
            <button id="showCatMenu" class="px-4 py-2 inline-flex items-center rounded bg-white bg-opacity-25 text-white font-semibold transform hover:scale-110">Create category
                <span class="mt-px">
                    <svg class="h-6 w-6 mt-px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </span>
            </button>
    </div>
</nav>
<div id="create-form" class="flex items-center h-screen opacity-0 pointer-events-none fixed inset-0 bg-black bg-opacity-50 transition-opacity ease-in duration-150 z-10">
    <form id="fromCR"
          class="space-y-4 w-full flex flex-col px-10 pt-10 pb-20 mx-auto max-w-lg bg-white"
          method="POST">
        <h1 id="menu_title" class="mb-10 font-semibold text-2xl text-center">Create a new bookmark!</h1>
        <input class="px-4 py-2 border-2 outline-none rounded appearance-none hidden" id="cat" type="text" placeholder="Categorie naam" value="">
        <input class="px-4 py-2 border-2 outline-none rounded appearance-none" id="title" type="text" placeholder="Name" value="">
        <input class="px-4 py-2 border-2 outline-none rounded appearance-none" id="url" type="text" placeholder="https://www.google.com/" value="">
        <select class="px-4 py-2 border-2 outline-none rounded appearance-none" id="cat_id">
            <?php foreach ($cats as $cat) : ?>
                <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
            <?php endforeach; ?>
        </select>
        <button id="add" class="px-4 py-2 bg-blue-500 rounded font-semibold text-white">Create new bookmark</button>
    </form>
</div>
<div id="editMenu" class="flex items-center h-screen opacity-0 pointer-events-none fixed inset-0 bg-black bg-opacity-50 transition-opacity ease-in duration-150 z-10">
    <form id="editForm"
          class="space-y-4 w-full flex flex-col px-10 pt-10 pb-20 mx-auto max-w-lg bg-white"
          method="POST">
        <h1 id="menu_title" class="mb-10 font-semibold text-2xl text-center">Edit bookmark!</h1>
        <input class="px-4 py-2 border-2 outline-none rounded appearance-none" id="title" type="text" placeholder="Name" value="">
        <input class="px-4 py-2 border-2 outline-none rounded appearance-none" id="url" type="text" placeholder="https://www.google.com/" value="">
        <select class="px-4 py-2 border-2 outline-none rounded appearance-none" id="cat_id">
            <?php foreach ($cats as $cat) : ?>
                <option id="<?= $cat->id ?>" value="<?= $cat->id ?>"><?= $cat->name ?></option>
            <?php endforeach; ?>
        </select>
        <button id="saveEdit" class="px-4 py-2 bg-blue-500 rounded font-semibold text-white">Save changes</button>
    </form>
</div>
<div class="px-4 md:mt-32 mt-6 sm:mt-20 mb-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 w-full container mx-auto max-w-screen-xl">
    <?php foreach ($cats as $cat) : ?>
        <div id="item" class="opacity-0">
            <h1 class="font-bold text-2xl"><?= $cat->name; ?></h1>
            <div class="space-y-2 flex flex-col">
                <?php foreach ($bladwijzers->GetItemsByCat($cat->id) as $item) : ?>
                    <span id="<?= $item->id; ?>" class="group inline-flex items-center space-x-4"><a target="_blank" class="flex items-center underline hover:no-underline outline-none" href="<?= $item->url; ?>"><div class="h-6 w-6 bg-no-repeat object-contain bg-center" style='background-image: url(https://www.google.com/s2/favicons?domain=<?= $item->url ?>);'></div><span><?= $item->title; ?></span></a>
                        <span onclick="removeItem(<?= $item->id; ?>)" class="group-hover:block md:hidden h-6 w-6 text-red-500 cursor-pointer transform hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </span>
                        <span onclick="editItem(<?= $item->id; ?>)" class="group-hover:block md:hidden h-5 w-5 cursor-pointer transform hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </span>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
    const tl = gsap.timeline({defaults: { ease: 'power1.out' }});
    tl.fromTo('#item', { y: '-70%' }, { y: '0%', opacity: 100, duration: 1 });
</script>
<script src="./js/app.js"></script>
</body>
</html>