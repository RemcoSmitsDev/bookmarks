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
function editItem(editId){
    $('#editForm > #cat_id > option:selected').removeAttr('selected');
    $.ajax({
        type: "GET",
        url: "proccess.php",
        data: {
            editId: editId,
        },
        dataType: 'json',
        success: function(data) {
            $("#editForm > #title").val(data.title);
            $("#editForm > #url").val(data.url);
            $("#editForm > #cat_id > #" + data.cat_id).attr("selected",true);
            $("#editMenu").toggleClass("opacity-0 pointer-events-none");
        }
    });
    $("#saveEdit").click((e) => {
        e.preventDefault();
        const edit_title = $("#editForm > #title").val();
        const edit_url = $("#editForm > #url").val();
        const edit_cat_id = $("#editForm > #cat_id").val();
        $.ajax({
            type: "POST",
            url: "proccess.php",
            data: {
                editId: editId,
                edit_title: edit_title,
                edit_url: edit_url,
                edit_cat_id: edit_cat_id
            },
            success: function() {
                location.reload();
            }
        });
    });

}
$(document).ready(() => {
    $("#editMenu").click((event) => {
        if(event.target.id=="editMenu"){
            $("#editMenu").toggleClass("opacity-0 pointer-events-none");
        }
    });

    $("#create-form").click((event) => {
        if(event.target.id=="create-form"){
            $("#create-form").toggleClass("opacity-0 pointer-events-none");
        }
    });
    $("#showItemMenu").click(() => {
        $("#menu_title").text("Create a new bookmark!");
        $("#create-form").toggleClass("opacity-0 pointer-events-none");
        $("#create-form #cat").addClass("hidden");
        $("#create-form #url, #title, #cat_id").removeClass("hidden");
    })
    $("#showCatMenu").click(() => {
        $("#menu_title").text("Create a new category!");
        $("#create-form").toggleClass("opacity-0 pointer-events-none");
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
                        $("#create-form").toggleClass("opacity-0 pointer-events-none");
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
                        $("#create-form").toggleClass("opacity-0 pointer-events-none");
                        location.reload();
                    }
                });
            }
        }
    });
});