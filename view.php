<!DOCTYPE html>
<html>
	<head>
		<title>Наши пользователи</title>
		<link rel="stylesheet" href="style.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body>
       <p>Namespace</p>
       <p><?php $app1 = new \lib1\core\App(); ?></p>
       <p><?php $app2 = new \lib2\core\App(); ?></p>
		<header>
			<h1>Наши пользователи</h1>
		</header>
		<form name="mass_delete" method="post" action="delete.php">
			<ul>
			<?php foreach($users as $user): ?>
				<li>
					<input type="checkbox" name="users_ids[]" value="<?= $user['id']; ?>" />
					<h2><?= $user['firstname'] . " " . $user['lastname']?></h2>
					<p><?= $user['phone']?></p>
					<p><?= $user['email']?></p>
					<a href="create.php?user_id=<?= $user['id'] ?>">Редактировать</a> / <a href="delete.php?user_id=<?= $user['id'] ?>">Удалить</a>
				</li>
			<?php endforeach; ?>
			</ul>
            <input class="delete" type="submit" name="delete_users" value="Удалить выбранные" />

		<footer>
			<a type="button" href="create.php">Добавить Пользователя</a>
		</footer>
        </form>
	</body>
</html>