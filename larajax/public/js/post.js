
// Send CSRF token
$.ajaxSetup({
    headers:
    {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//Add And Handle Code
// Access Form
$("#addPost").submit(function(e){

// prevent default action of form
    e.preventDefault();

// Clear Old Errors
    let menu = document.getElementById('errors');
    menu.innerHTML = '';

// save form data in varibale
    var formData = $("#addPost").serialize();


$.ajax({
    url:'/add-post',
    type:"POST",
    data:formData,
    success:function(dataBack)
    {
        //Add alert of success
        $("#success").html("<h4 class='text-success text-center'>Add Success</h4>");
        //Add new HTML code "Returned from the controller"
        $(".cont-data").prepend(dataBack);
        //Hide The form modal
        $("#exampleModal").modal('hide');
        //Clear the form feilds
        var title = document.getElementById("title");
        title.value = '';
        var title = document.getElementById("desc");
        title.value = '';

    },
    error:function(xhr , status , error)
    {

        $.each(xhr.responseJSON.errors , function(key, item)
        {
            console.log(item);
            $("#errors").append("<li class='text-danger'>"+item+"</li>")
        });
    }

})
})

//Edit Code
$(".edit-skill").click(function(){
    var route = $(this).attr("data-route");


    $.ajax({
        url: route,
        type:"GET",
        dataType:"JSON",
        success:function(dataBack)
        {
            //Add Returned Data  of success
            $("#e_title").val(dataBack.title);
            $("#e_desc").val(dataBack.desc);
            $("#id").val(dataBack.id);
        },
    })
})


//edit form
$("#editSkill").submit(function(e){

    // prevent default action of form
        e.preventDefault();

    // Clear Old Errors
        let menu = document.getElementById('e_errors');
        menu.innerHTML = '';

    // save form data in varibale
        var formData = $("#editSkill").serialize();
        var rowId = $("#id").val();
        console.log("row from id = " + rowId);


    $.ajax({
        url:'/update-skill',
        type:"POST",
        data:formData,
        success:function(dataBack)
        {
            //Add alert of success
            $("#success").html("<h4 class='text-success text-center'>Edit Success</h4>");

            //Add new HTML code "Returned from the controller"
            // console.log("row from form= " + formData)
            $("#"+rowId).html(dataBack);
            //Hide The form modal
            $("#editModal").modal('hide');

        },
        error:function(xhr , status , error)
        {

            $.each(xhr.responseJSON.errors , function(key, item)
            {
                console.log(item);
                $("#e_errors").append("<li class='text-danger'>"+item+"</li>")
            });
        }

    })
    })


//Delete Button
$(document).on("click" , ".delete-post" , function(){

    var route = $(this).attr("data-route");
    // console.log(route);

    $.ajax({
        url:route,
        type:"GET",
        success:function(dataBack)
        {
            // alert(dataBack.success);
            $("#success").html("<h4 class='text-success text-center'>"+dataBack.success+"</h4>");

            $("#"+dataBack.id).remove();
        }
    })
})
