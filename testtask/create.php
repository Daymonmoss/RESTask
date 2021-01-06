<?php
require 'model.php';

$id = isset($_REQUEST['user_id']) ? ((int) $_REQUEST['user_id']) : 0;
$e_firstname = $e_lastname = $e_name = $e_phone = $e_email = $e_mail = '';

if (isset($_POST['submit'])) {
	
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	
    if ($firstname == ""){
        $e_firstname = "<span class=\"alert\">Укажите имя</span>";
    } elseif($lastname == ""){
        $e_lastname = "<span class=\"alert\">Укажите фамилию</span>";
    } elseif(mb_strlen($firstname) < 3 || mb_strlen($lastname) < 2 || mb_strlen($firstname) > 20 || mb_strlen($lastname) > 20 ){
        $e_name = "<span class=\"alert\">Что-то непохоже на имя и фамилию</span>";
    } elseif($phone == ""){
        $e_phone = "<span class=\"alert\">Укажите номер телефона</span>";
    } elseif($email == ""){
        $e_email = "<span class=\"alert\">Укажите адрес эпочты</span>";
    } elseif (!preg_match("/[0-9a-z_\.\-]+@[0-9a-z_\.\-]+\.[a-z]{2,4}/i", $_POST['email'] )){
        $e_mail = "<span class=\"alert\">Так email не пишется</span>";
    } else {
		
		if($id > 0) {
			editUser($id, $firstname, $lastname, $phone, $email);
		} else {
			addUser($firstname, $lastname, $phone, $email);
		}
        header("Location: index.php");
    }
}

if($id > 0) {
	$user = getUser($id);
} else {
	$user = false;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Наши пользователи</title>
		<link rel="stylesheet" href="style.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
	</head>
	<body>
		<form action="create.php" method="post">

			<input type="hidden" name="user_id" value="<?= $user ? $user[0]['id'] : 0; ?>" />

			<input name="firstname" placeholder="Введите имя" value="<?= $user ? htmlspecialchars($user[0]['firstname']) : ''; ?>"><?= $e_firstname ?><br>

			<input name="lastname" placeholder="Введите фамилию" value="<?= $user ? htmlspecialchars($user[0]['lastname']) : ''; ?>"><?= $e_lastname . $e_name?><br>

			<input class="phone" name="phone" placeholder="Укажите номер телефона" class="phone" value="<?= $user ? htmlspecialchars($user[0]['phone']) : ''; ?>"><?= $e_phone ?><br>

			<input name="email" placeholder="Укажите email" value="<?= $user ? htmlspecialchars($user[0]['email']) : ''; ?>"><?= $e_email, $e_mail?><br>

			<input type="submit" name="submit" value="Сохранить">

		</form>
		<a type="button" href="index.php">Назад</a>
	</body>
	<script>
		$(".phone").mask("+380(99)999-9999");
	</script>
</html>

