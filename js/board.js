    // Loads whole notes container 
function loadNotes(){
    if (!$("#openNotes li").hasClass("active")){
        $("container").load("view/templates/notesContainerTemplate.html", function(){
            loadNotePosts();
            $("nav ul li").removeClass("active");
            $("#openNotes li").addClass("active");
        });
    }
}

    // Loads whole info container 
function loadInfo(){
    if (!$("#openInfo li").hasClass("active")){
        $("container").load("view/templates/infoContainerTemplate.html", function(){
            $("nav ul li").removeClass("active");
            $("#openInfo li").addClass("active");
        });
    }
}

    // Clears and loads only posts into note table
function loadNotePosts(){
    $.post("view/notes.php")
    .done(function(data){ 
        $("tr.post").remove();
        if (data == "    failed") {
            $("div#notes table").append('<tr><td colspan=99><h1 style="text-align:center;">Brak postów.</h1></td></tr>');
        } else {
            $("div#notes table").append(data);
        }
        triggerNotesActions();
    });
}

function triggerNewNotePostEditingActions(){
    $("button.submitPost.newPost").unbind().click(function(e){ 
        e.preventDefault();
        $form = $(e.target).parent().parent();
        if ($form.children("input[type='text']").val()=='') {
            $(e.target).html("Wpisz tytuł notatki!");
        } else {
            $(e.target).html("Zapisuję...");
            $subject=$form.children("input[type='text']").val();
            $content=$form.children("textarea").val();
            $.post("form/addNote.php", { subject:$subject, content:$content })
                    .done(function(data){ 
                        if (data=="failed" || data=='') { 
                            $(e.target).html("Nie udało się zapisać notatki!"); 
                        } else {
                            loadNotePosts();
                            $("tr#addPost").removeClass("open");
                            $("tr#newPost").children("td").children("div")
                                .slideUp(150, function(){
                                $("tr#newPost").hide(); 
                            });
                            $(e.target).html("Zapisz");
                            $form.children("input[type='text']").val("");
                            $form.children("textarea").val("");
                        }
                    });
        }
    });
};


function triggerNotePostEditingActions(){
    $("tr.existingPost button.submitPost").unbind().click(function(e){ 
        e.preventDefault();
        $form = $(e.target).parent().parent();
        if ($form.children("input[type='text']").val()=='') {
            $(e.target).html("Wpisz tytuł notatki!");
        } else {
            $(e.target).html("Zapisuję...");
            $id=$form.attr("name").substr(5);
            $subject=$form.children("input[type='text']").val();
            $content=$form.children("textarea").val();
            $.post("form/updateNote.php", { id:$id, subject:$subject, content:$content })
                    .done(function(data){ 
                        if (data=="failed" || data=='') { 
                            $(e.target).html("Nie udało się zapisać notatki!"); 
                        } else {
                            $maintr=$form.parent().parent().parent().prev("tr.post");
                            $maintr.removeClass("open").children("td").first()
                                .text($subject.substring(0, 31)).next("td")
                                .text($content.substring(0, 111));
                            $form.parent().slideUp(100, function(){
                                $form.parent().parent().parent().remove();
                            });
                        }
                    });
        };
    });
    
    $("tr.existingPost button.deletePost").unbind().click(function(e){ 
        e.preventDefault();
        if (!$(e.target).hasClass("confirm")) {
            $(e.target).addClass("confirm").text("Na pewno?");
        } else {
            $form = $(e.target).parent().parent();
            $id=$form.attr("name").substr(5);
            $.post("form/deleteNote.php", { id:$id })
                    .done(function(data){ 
                        if (data=="failed" || data=='') { 
                            $(e.target).html("Błąd..."); 
                        } else {
                            $maintr=$form.parent().parent().parent().prev("tr.post");
                            $maintr.remove();
                            $form.parent().slideUp(100, function(){
                                $form.parent().parent().parent().remove();
                            });
                        }
                    });
        }
    });
}

function triggerNotesActions(){
    $("tr.post").unbind().click(function(e){
            $parent=$(e.target).parent();
            if ($(this).hasClass("open")) {
                $(this).removeClass("open");
                $parent.next("tr.editPost").children("td").children("div")
                    .slideUp(150, function(){
                        $parent.next("tr.editPost").remove(); 
                });
            } else {
                $id=$parent.attr("name").substr(5);
                $.post("view/getNote.php", { id:$id })
                    .done(function(data){ 
                        if (data=="failed") { alert("Błąd pobierania danych!"); }
                        else {
                            $parent.addClass("open");
                            $parent.after(data).next("tr.editPost").show().children("td").children("div").slideDown(50, function(){
                                triggerNotePostEditingActions();
                                 autosize($("textarea"));
                                 autosize.update($("textarea"));
                            });
                        }
                });
            }
        });
    
    $("tr#addPost").unbind().click(function(e){
       if (!$(e.target).parent().hasClass("open")) {
           $("tr#addPost").addClass("open");
           $("tr#newPost").show().children("td").children("div").slideDown(50, function(){
                 $("tr#newPost input[name='subject']").focus();
                 triggerNewNotePostEditingActions();
                 autosize($("textarea"));
            });
       } else {
           $(e.target).parent().removeClass("open");
           $("tr#newPost").children("td").children("div").slideUp(150, function(){
                $("tr#newPost").hide(); 
            });
       }
    });
}

$(function(){
    
    $('#menu-toggle-wrapper').click(function(){
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $("nav").animate({width: 'toggle'}, 150);
        } else {
            $(this).addClass("active");
            $("nav").animate({width: 'toggle'}, 150);
        }
    });
    
    $(document).click(function(e){
        if (!$(e.target).is(".dropdown") && !$(e.target).is(".dropdown-item"))
            $(".dropdown-menu").hide(100);
    });
    $("a.dropdown").click(function(e){
        e.preventDefault();
    });
    $("#navUserDropdown").click(function(e){
        var target=$(this).next(".dropdown-menu");
        $(target).toggle(100);
    });
    $("a.dropdown-item").click(function(e){
        e.preventDefault();
    });
    
    $("#logout").click(function(){
        $.post("form/logout.php", {  })
            .done(function(data){
                if (data=="success") {
                    $(location).attr('href', '.');
                } else {
                    alert("Wylogowanie nie powiodło się!");
                }
             });
    });
    
    $("#openNotes").click(function(){ loadNotes(); });
	 $("#openInfo").click(function(){ loadInfo(); });
    
    loadNotes();
    
    
    
    
});