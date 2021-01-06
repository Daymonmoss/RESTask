<?php
$id = isset($_REQUEST['user_id']) ? ((int) $_REQUEST['user_id']) : 0;

$errors = file_get_contents('http://testtask.ok/processing.php');
$url = file_get_contents('http://testtask.ok/api/?api_key=7ed1538cb1&user_id='.$id);
$user = json_decode($url, true);

if (isset($_POST['submit'])) {
 header("Location: /");
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
    <div id="response"></div>
		<form action="create.php" method="post">

			<input type="hidden" name="user_id" value="<?= $user['id'] ?>" />

			<input id="firstname" name="firstname" placeholder="Введите имя" value="<?= $user['firstname'] ?>"><br>

			<input id="laname" name="lastname" placeholder="Введите фамилию" value="<?= $user['lastname'] ?>"><br>

			<input class="phone" name="phone" placeholder="Укажите номер телефона" class="phone" value="<?= $user['phone'] ?>"><br>

			<input name="email" placeholder="Укажите email" value="<?= $user['email'] ?>"><br>

			<input type="submit" id="submit" name="submit" value="Сохранить">

		</form>

		<a type="button" href="index.php">Назад</a>
	</body>
	<script>
		$(".phone").mask("+380(99)999-9999");
	</script>
    <script>

        const forms = document.getElementsByTagName('form');
        for (let i = 0; i < forms.length; i++) {
            forms[i].addEventListener('submit', function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                formData = Object.fromEntries(formData);

                ajaxSend(formData);
                this.reset();
            });
        };

            const ajaxSend = (formData) => {
                fetch('http://testtask.ok/processing.php', {
                    method: 'POST',
                    mode: 'no-cors',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData)
                })
                    .catch(error => console.log(error))
            };


    </script>
</html>

