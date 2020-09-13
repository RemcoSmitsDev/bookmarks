<?php
require_once "./config/init.php";
if(!isset($_SESSION['_user'])){
    header("location: ./");
}
$bladwijzers = new Bladwijzers();
$user = new Login();
$cats = $bladwijzers->GetAllCats();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bladwijzers - Made by Rswebdevelopment</title>
    <link rel="stylesheet" media="all" href="./css/tailwindcss.css">
</head>

<body class="p-10 w-full h-screen bg-gray-100">
<div class="md:flex md:space-x-10 md:justify-center ">
    <?php if(count($cats) > 0): ?>
    <button id="showItemMenu" class="px-4 py-2 space-x-2 inline-flex items-center justify-center rounded bg-indigo-600 text-white border hover:border-indigo-600 hover:bg-white hover:text-indigo-600">
        <h1 class="text-2xl font-semibold">Create item</h1>
        <svg class="h-6 w-6 mt-1 animate-pulse" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
    </button>
    <?php endif; ?>
    <button id="showCatMenu" class="px-4 py-2 inline-flex items-center justify-center rounded border bg-indigo-600 text-white hover:border-indigo-500 hover:bg-white hover:text-indigo-500">
        <h1 class="text-3xl font-semibold">Create category</h1>
        <svg class="h-6 w-6 mt-1 animate-pulse" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
    </button>
</div>
<div id="create-form" class="flex items-center h-screen opacity-0 hidden fixed inset-0 bg-black bg-opacity-50 transition-opacity ease-in duration-150 z-10">
    <form id="fromCR"
          class="space-y-4 w-full flex flex-col px-10 pt-10 pb-20 mx-auto max-w-lg bg-white"
          method="POST">
        <h1 id="menu_title" class="mb-10 font-semibold text-2xl text-center">Voeg een nieuw item toe!</h1>
        <input class="px-4 py-2 border-2 outline-none rounded appearance-none hidden" id="cat" type="text" placeholder="Categorie naam" value="">
        <input class="px-4 py-2 border-2 outline-none rounded appearance-none" id="title" type="text" placeholder="Name" value="">
        <input class="px-4 py-2 border-2 outline-none rounded appearance-none" id="url" type="text" placeholder="https://www.google.com/" value="">
        <select class="px-4 py-2 border-2 outline-none rounded appearance-none" id="cat_id">
            <?php foreach ($cats as $cat) : ?>
                <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
            <?php endforeach; ?>
        </select>
        <button id="add" class="px-4 py-2 bg-blue-500 rounded font-semibold text-white">Create new one</button>
    </form>
</div>
<div class="mt-10 md:mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
    <?php foreach ($cats as $cat) : ?>
        <div>
            <h1 class="font-bold text-2xl"><?= $cat->name; ?></h1>
            <div class="space-y-2 flex flex-col">
                <?php foreach ($bladwijzers->GetItemsByCat($cat->id) as $item) : ?>
                    <span id="<?= $item->id; ?>" class="group inline-flex space-x-4"><a target="_blank" class="underline hover:no-underline outline-none" href="<?= $item->url; ?>"><?= $item->title; ?></a> <span onclick="removeItem(<?= $item->id; ?>)" class="group-hover:block md:hidden h-6 w-6 text-red-500 cursor-pointer transform hover:scale-110"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
</svg></span></span>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

</div>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script type="text/javascript">
    function removeItem(id){
        if (confirm("Weet u zeker dat u deze wilt verwijderen?")){
            $.ajax({
                type: "POST",
                url: "proccess.php",
                data: {
                    id: id,
                },
                success: function() {
                    $("#" + id).fadeOut();
                }
            });
        }
    }
    $(document).ready(() => {

        $("#create-form").click((event) => {
            if(event.target.id=="create-form"){
                $("#create-form").toggleClass("opacity-0 hidden");
            }
        });
        $("#showItemMenu").click(() => {
            $("#menu_title").text("Voeg een nieuw item toe!");
            $("#create-form").toggleClass("opacity-0 hidden");
            $("#create-form #cat").addClass("hidden");
            $("#create-form #url, #title, #cat_id").removeClass("hidden");
        })
        $("#showCatMenu").click(() => {
            $("#menu_title").text("Voeg een nieuw categorie toe!");
            $("#create-form").toggleClass("opacity-0 hidden");
            $("#create-form #cat").removeClass("hidden");
            $("#create-form #url, #title, #cat_id").addClass("hidden");
        })
        $("#add").click((e) => {
            if($("#create-form #cat").hasClass("hidden")){
                const title = $("#title").val();
                const url = $("#url").val();
                const cat_id = $("#cat_id").val();
                e.preventDefault();
                if (title !== "" && url !== "") {
                    $.ajax({
                        type: "POST",
                        url: "proccess.php",
                        data: {
                            title: title,
                            url: url,
                            cat_id: cat_id,
                        },
                        success: function(data) {
                            $("#create-form").toggleClass("opacity-0 hidden");
                            location.reload();
                        }
                    });
                }
            }else{
                e.preventDefault();
                const cat = $("#create-form #cat").val();
                if(cat !== ""){
                    $.ajax({
                        type: "POST",
                        url: "proccess.php",
                        data: {
                            cat: cat,
                        },
                        success: function(data) {
                            $("#create-form").toggleClass("opacity-0 hidden");
                            location.reload();
                        }
                    });
                }
            }
        });
    })
</script>
</body>

</html>