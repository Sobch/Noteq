function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

$(function(){
	
	$(function(){
		var y = 0;
		setInterval(function(){
			y+=1;
			if (y==400) y=0;
			$('body').css('background-position', '0 '+y+'px');
		}, 100);
	});
	
	$('form[name=login] button#login').click(function(event){
        event.preventDefault();
		$valid=true;
		if (!validateEmail($("form[name='login'] input[name='email']").val())) {
			//$("#wrongem").show();
			$("form[name='login'] input[name='email']").addClass("error");
			$valid=false;
		}
		else {
			//$("#wrongem").hide();
			$("form[name='login'] input[name='email']").removeClass("error");
		}
		
		if (!$("form[name='login'] input[name='password']").val()) { 
			//$("#nopw").show();
			$("form[name='login'] input[name='password']").addClass("error");
			$valid=false;
		}
		else {
			//$("#nopw").hide();
			$("form[name='login'] input[name='password']").removeClass("error");
		}
		
		if ($valid) { 
			$(this).prop("disabled", true).text("Logowanie...");
			var email = $("form[name='login'] input[name='email']").val();
			var pw = $("form[name='login'] input[name='password']").val();
			$.post("form/login.php", { email:email, pw:pw })
				.done(function(data){
					if (data=="success") {
						$("button#login").prop("disabled", false).text("Zalogowano!");
                        $(location).attr('href', 'board');
                        
					} else {
						$("form[name='login'] input[name='email']").addClass("error");
						$("form[name='login'] input[name='password']").addClass("error");
						$valid=false;
						$("button#login").prop("disabled", false).text("Niepoprawne dane!");
						alert(data);
					}
			});
		}
	});
    
    $("form[name='signup'] button#register").click(function(event){
        event.preventDefault();
		$valid=true;
		if (!validateEmail($("form[name='signup'] input[name='email']").val())) {
			//$("#wrongem").show();
			$("form[name='signup'] input[name='email']").addClass("error");
			$valid=false;
		}
		else {
			//$("#wrongem").hide();
			$("form[name='signup'] input[name='email']").removeClass("error");
		}
		
		if (!$("form[name='signup'] input[name='password']").val()) { 
			//$("#nopw").show();
			$("form[name='signup'] input[name='password']").addClass("error");
			$valid=false;
		}
		else {
			//$("#nopw").hide();
			$("form[name='signup'] input[name='password']").removeClass("error");
		}
        if (!$("form[name='signup'] input[name='passwordRepeat']").val()) { 
			//$("#nopw").show();
			$("form[name='signup'] input[name='passwordRepeat']").addClass("error");
			$valid=false;
		}
		else {
			//$("#nopw").hide();
			$("form[name='signup'] input[name='passwordRepeat']").removeClass("error");
		}
        if ($("form[name='signup'] input[name='password']").val() != $("form[name='signup'] input[name='passwordRepeat']").val()) { 
			//$("#nopw").show();
			$("form[name='signup'] input[name='password']").addClass("error");
            $("form[name='signup'] input[name='passwordRepeat']").addClass("error");
			$valid=false;
		}
		
		if ($valid) { 
			$(this).prop("disabled", true).text("Rejestrowanie...");
			var email = $("form[name='signup'] input[name='email']").val();
			var pw = $("form[name='signup'] input[name='password']").val();
            var pwr = $("form[name='signup'] input[name='passwordRepeat']").val();
			$.post("form/signup.php", { email:email, pw:pw, pwr:pwr })
				.done(function(data){
					if (data=="success") {
						$("button#register").prop("disabled", false).text("Zarejestrowano!");
                        signUpOn=false;
                        $("#signUp").fadeOut("fast", function() {
                            $(".fade").fadeOut("fast");
                        });
                        alert("Zarejestrowano!");
                        
					} else if (data=="failed"){
						$("form[name='signup'] input[name='email']").addClass("error");
						$("form[name='signup'] input[name='password']").addClass("error");
						$valid=false;
						$("button#register").prop("disabled", false).text("Nie zarejestrowano!");
					} else if (data=="exist"){
						$("form[name='signup'] input[name='email']").addClass("error");
						$valid=false;
						$("button#register").prop("disabled", false).text("Użytkownik już istnieje!");
					}
			});
		}
	});
	
	$("#signUpLink").click(function(event){
		event.preventDefault();
		$( ".fade" ).fadeIn( "fast", function() {
			$("#signUp").fadeIn("fast");
		});
	});
	
	$(".fade").click(function(event){
		if ($(event.target).is('.fade')) {
			signUpOn=false;
			$("#signUp").fadeOut("fast", function() {
				$(".fade").fadeOut("fast");
			});
		}
	});
    

	
});







