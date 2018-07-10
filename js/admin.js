$(function(){
    $("span.delete").click(function(e){
       if (!$(e.target).hasClass("confirm")) {
           $(e.target).addClass("confirm").text("na pewno?");
       }
       else {
           $(e.target).unbind().text("usuwanie...");
           $id=$(e.target).attr("name");
           $.post( "form/deleteUser.php", { id:$id } )
                .done(function(data){ 
                    if (data=="success"){
                        location.reload();
                    } else {
                        alert(data);
                        alert("Błąd usuwania");
                        location.reload();
                    }
           });
        }
    });
});