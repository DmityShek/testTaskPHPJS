<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>tasks</title>
<!--	<link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<header>
	<div class="container-fluid bg-dark text-light" style="height: 60px">
		<div class="row">
			<div class="col text-center pt-3">A D M I N</div>
		</div>
	</div>
</header>

<div class="container main_block">
	<div class="row">
		<div class="col">
			<div class="mb-4 text-dark text-uppercase text-center mt-4">Введите ваши данные</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col">
        <?php if (isset($data['errors'])): ?><?php foreach ($data['errors'] as $error): ?>
					<div class="alert alert-danger" role="alert">
              <?php echo $error; ?>
					</div>
        <?php endforeach; ?>
        <?php endif; ?>

			<form action="" method="post" class="signup-form">
				<div class="form-group row">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Имя</label>
					<div class="col-sm-10">
						<input type="text" name="name" class="form-control" id="inputEmail3" placeholder="-" value="<?php if (isset($data['name'])) echo $data['name']?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Пароль</label>
					<div class="col-sm-10">
						<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="-">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-10">
						<input type="submit" name="submit" class="btn btn-dark" value="Вход"/>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col">
			<ul class="list-group list-group-flush">
				<li class="list-group-item">
					<a href="/" class="text-danger">Вернуться на сайт</a>
				</li>
			</ul>
		</div>
	</div>
</div>

</body>
</html>
