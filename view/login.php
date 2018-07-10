<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="Stylesheet" type="text/css" href="css/login.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/loginValidation.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script> -->

</head>

<body>
	<div class="container">
	  <div class="intro">
		<h1> noteq </h1>
		<h2>Łatwo stwórz swoje notatki online.</h2>
		<p>Nie masz konta?   <a href="" id="signUpLink">Zarejestruj się tutaj! </a></p>
	  </div>
	  <div class="login">
		<h1>Zaloguj się!</h1>
		<form method="post" name="login">
			<input type="text" name="email" placeholder="e-mail" required="required" />
			<span class="message error" id="wrongem">Podaj poprawny e-mail!</span>
			<span class="message error" id="noem">Nie ma takiego konta!</span>
			<input type="password" name="password" placeholder="hasło" required="required" />
			<span class="message error" id="nopw">Podaj hasło!</span>
			<span class="message error" id="wrongpw">Błędne hasło!</span>
			<button type="submit" class="btn btn-primary btn-block btn-large" id="login">OK</button>
		</form>
	  </div>
	</div>
	
	<div class="fade" style="display:none;"/>
	<div id="signUp" style="display:none;">
		<form method="post" name="signup">
			<h1 class="text-center">Zarejestruj się!</h1>
			<input type="text" name="email" placeholder="e-mail" required="required" />
			<input type="password" name="password" placeholder="hasło" required="required" />
            <input type="password" name="passwordRepeat" placeholder="powtórz hasło" required="required" />
			<button type="submit" class="btn btn-primary btn-block btn-large" id="register">OK</button>
		</form>
	</div>
  

</body>
</html>