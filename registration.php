<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Регистрационная форма</title>
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

		$error_name = '';
		$error_email = '';
		$error_pass = '';

		$name_none='';
		$email_none='';
		$pass_none='';

		if(empty($_POST[name])){ 
			$error_name= "<p class='error'>Введите логин</p>";
			 $name_none = 'none';
		}
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
		$success = '';
		
		$link = mysqli_connect($host, $user, $password, $database) 
		or die("Ошибка " . mysqli_error($link));

		 $query = '';

		if(!empty($_POST[name] && !empty($_POST[email]) && filter_var($_POST[email], FILTER_VALIDATE_EMAIL)==true  && !empty($_POST[password]))){

			$_POST[password] = password_hash($_POST[password],PASSWORD_DEFAULT);
			$_POST[name] = mysqli_real_escape_string($link ,$_POST[name]);
			$_POST[email] = mysqli_real_escape_string($link, $_POST[email]);
			$query = "INSERT INTO users VALUES ('{$_POST[name]}','{$_POST[email]}','{$_POST[password]}')";
				
			mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
		     
			mysqli_close($link);
		}

		if($result)
		{
		    $success="<p class='success'>Регестрация выполнена успешно!</p>";
		}

	?>

	<h1>Регистрационная форма</h1>
	
	<form method="POST" action="./registration.php">
		<label for="name"><h3>Имя:</h3></label>
	<p>
		<input type="text" name="name" class=<?= $name_none ?>>
	</p>
	<?= $error_name?>
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
		<button type="submit">РЕГИСТРАЦИЯ</button>
	</p>
	</form>
	<?php if($result): ?>
	<p class='success'>Регестрация выполнена успешно!</p>
	<?php endif;?>

</body>
</html>