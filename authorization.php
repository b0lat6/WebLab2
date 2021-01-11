<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Вход на сайт</title>
	<link rel="stylesheet" href="./style5.css">
</head>
<body>

	<header class="page-header">
        <nav class="main-menu">
          <ul>
            <li><a href="index.html">Мой сайт</a></li>
            <li><a href="43.html">Задание 3</a></li>
            <li><a href="44.html">Задание 4</a></li>
            <li><a href="45.html">Задание 5</a></li>
            <li><a href="registration.php">Регистрация</a></li>
            <li><a href="authorization.php">Войти</a></li>
          </ul>
        </nav>
    </header>

	<?php

		$error_email = '';
		$error_pass = '';

		$email_none='';
		$pass_none='';

		if ((filter_var($_POST[email], FILTER_VALIDATE_EMAIL)==false)){
			$error_email = "<p class='error'>Неверный формат</p>";
			$email_none='none';
		}
		if (empty($_POST[email])){
			$error_email = "<p class='error'>Введите email</p>";
			$email_none='none';
		}
		 if (empty($_POST[password])){
			$error_pass = "<p class='error'>Введите пароль</p>";
			$pass_none='none';
		}

		$host = 'localhost';
		$database = 'my_db';
		$user = 'root';
		$password = '';
		
		$link = mysqli_connect($host, $user, $password, $database) 
		or die("Ошибка " . mysqli_error($link));

		 $query = '';

		if(!empty($_POST[email]) && filter_var($_POST[email], FILTER_VALIDATE_EMAIL)==true  && !empty($_POST[password])) {
		
			$_POST[email] = mysqli_real_escape_string($link, $_POST[email]);

			$query = "SELECT * FROM users WHERE email='{$_POST[email]}'";
			$res = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
			if(!empty($res)){
			for ($data = []; $row = mysqli_fetch_assoc($res); $data[] = $row);
		
			if(password_verify($_POST[password], $data[0][password])){
					$welcome='<p style="color:green;">Добро пожаловать, %s!</p>';
					printf($welcome, $data[0][name]) ;
			} else{
			echo "<p style='color:red;'>Неверный логин или пароль</p>";
		}
			} 
			print_r($res->password);
		     
		}
			mysqli_close($link);

	?>

	<h1>Вход на сайт</h1>
	
	<form method="POST">
	<label for="email"><h3>Email:</h3></label>
	<p>
		<input type="e-mail" name="email" class=<?= $email_none ?>>
	</p>
	<?=$error_email ?>

	<label for="password"><h3>Пароль:</h3></label>
	<p>
		<input type="password" name="password" class=<?=$pass_none ?>>
	</p>
	<?=$error_pass ?>

	<p>
		<button type="submit">ВОЙТИ</button>
	</p>

</body>
</html>