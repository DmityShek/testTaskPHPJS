<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Задачи</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>
<header>
	<div class="container-fluid bg-dark " style="height: 60px">
      <?php if (isset($data['admin']) && $data['admin']): ?>
				<button class="btn btn-light mt-2">
					<a href="/admin/logout" style="text-decoration: none" class="text-dark">Выйти</a>
				</button>
      <?php else: ?>
				<button class="btn btn-light mt-2">
					<a href="admin/login" style="text-decoration: none" class="text-dark">Aвторизация</a>
				</button>
      <?php endif; ?>
	</div>
</header>
<div class="container main_block">
	<div class="row">
		<div class="col">
			<div class="text-dark text-uppercase text-center mt-4">Создание задачи</div>
		</div>
	</div>
</div>
<container>
	<div class="container">
		<div class="row text-left justify-content-center pt-4">
			<div class="col-lg-6">
				<!-- Notification -->
          <?php if (isset($data['errors'])): ?><?php foreach ($data['errors'] as $error): ?>
						<div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
						</div>
          <?php endforeach; ?><?php endif; ?>
          <?php if (isset($data['success']) && $data['success']): ?>
						<div class="alert alert-success fade show" id="myAlert" role="alert">
							<strong>Отлично! </strong>Ваша задача успешно добавлена.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
          <?php endif; ?>
				<form action="<?php echo $data['action']; ?>" method="post" style="box-shadow: 0 0 10px rgba(0,0,0,0.5);padding: 25px">
					<div class="form-group">
						<label>Имя</label>
						<input type="text" class="form-control" placeholder="-" name="name">
						<small type="text" class="form-text text-muted"></small>
					</div>
					<div class="form-group">
						<label>Задача</label>
						<input type="text" class="form-control" placeholder="-" name="task">
					</div>
					<div class="form-group">
						<label for="">E-mail</label>
						<input type="text" class="form-control" placeholder="-" name="email">
					</div>
					<input type="submit" name="submit" class="btn btn-dark" value="Добавить"/>
				</form>
			</div>
		</div>
	</div>
</container>
<container>
	<div class="container">
		<div class="row text-center justify-content-center pt-5 ">
			<div class="col-lg-10 text-center">
				<div class="row justify-content-between">
					<div class="col-sm-4">
						<div class="dropdown">
							<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Имя
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<button class="dropdown-item" onclick="mySort('name','asc')">По алфавиту</button>
								<button class="dropdown-item" onclick="mySort('name','desc')">В обратном порядке</button>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="dropdown">
							<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Email
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<button class="dropdown-item" onclick="mySort('email','asc')">По алфавиту</button>
								<button class="dropdown-item" onclick="mySort('email','desc')">В обратном порядке</button>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="dropdown">
							<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Статус
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

								<button class="dropdown-item" onclick="mySort('status','asc')">Сначала невыполненные</button>
								<button class="dropdown-item" onclick="mySort('status','desc')">Сначала выполненные</button>
							</div>
						</div>
					</div>
				</div>
				<table class="table shadow-lg mt-3 p-3 mb-5 bg-white rounded">
					<thead class="thead-dark">
					<tr>
						<th scope="col">Имя</th>
						<th scope="col">Задача</th>
						<th scope="col">E-mail</th>
						<th scope="col">Статус</th>
					</tr>
					</thead>
					<tbody>
          <?php foreach ($data['tasks'] as $task => $value): ?>
						<tr>
							<td><?php echo $value['name'] ?></td>
							<td>
                  <?php echo $value['task'] ?>
                  <?php if ($value['edit']): ?>
										<small style="color: darkred;display: flow-root;">*отредактировано администратором</small>
                  <?php endif; ?>
                  <?php if (isset($data['admin']) && $data['admin']): ?>
										<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalTaskEdit" style="background-image: url(/pensil.png);background-size: 15px 15px;background-repeat: no-repeat;    padding: 8px 8px;" data-id="<?php echo $value['id'] ?>" data-task="<?php echo $value['task'] ?>"></button>
                  <?php endif; ?>
							</td>
							<td><?php echo $value['email'] ?></td>
							<td>
                  <?php if (isset($data['admin']) && $data['admin']): ?><?php if ($value['status']): ?>
										<button type="button" class="btn btn-success status" data-toggle="button" data-id="<?php echo $value['id'] ?>" aria-pressed="<?php echo $value['status'] ? 'true' : 'false'; ?>" autocomplete="off">
                        <?php echo $value['status'] ? 'выполнено' : 'не выполнено'; ?>
										</button>
                  <?php else: ?>
										<button type="button" class="btn btn-danger status" data-toggle="button" data-id="<?php echo $value['id'] ?>" aria-pressed="<?php echo $value['status'] ? 'true' : 'false'; ?>" autocomplete="off">
                        <?php echo $value['status'] ? 'выполнено' : 'не выполнено'; ?>
										</button>
                  <?php endif; ?><?php else: ?><?php if ($value['status']): ?>
										<button type="button" class="btn btn-success status" data-toggle="button" data-id="<?php echo $value['id'] ?>" disabled aria-pressed="<?php echo $value['status'] ? 'true' : 'false'; ?>" autocomplete="off">
                        <?php echo $value['status'] ? 'выполнено' : 'не выполнено'; ?>
										</button>
                  <?php else: ?>
										<button type="button" class="btn btn-danger status" data-toggle="button" data-id="<?php echo $value['id'] ?>" disabled aria-pressed="<?php echo $value['status'] ? 'true' : 'false'; ?>" autocomplete="off">
                        <?php echo $value['status'] ? 'выполнено' : 'не выполнено'; ?>
										</button>
                  <?php endif; ?><?php endif; ?>
							</td>
						</tr>
          <?php endforeach; ?>
					</tbody>
				</table>
				<div class="btn-toolbar justify-content-center" role="toolbar" aria-label="Toolbar with button groups">

					<div class="btn-group" role="group" aria-label="First group">
              <?php foreach ($data['page'] as $page => $value): ?>
								<button type="button" onclick="window.location ='<?php echo $value['link'] ?>'" class="btn btn-dark <?php if ($data['active_link'] == $value['num']) {
                    echo 'active';
                } ?>"><?php echo $value['num']; ?>
								</button>
              <?php endforeach; ?>

					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="ModalTaskEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Редактирование задачи</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<input type="hidden" class="form-control" id="id">
								<label for="task" class="col-form-label">Текст:</label>
								<input type="text" class="form-control" id="task">
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
						<button type="button" id="btnSave" class="btn btn-primary">Сохранить</button>
					</div>
				</div>
			</div>
		</div>
</container>

<script>
  $('#ModalTaskEdit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var task = button.data('task');
    var modal = $(this);
    modal.find('.modal-body input#id').val(id);
    modal.find('.modal-body input#task').val(task);
  });


  $('#btnSave').click(function() {
    var id = $('#id').val();
    var task = $('#task').val();

    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: 'update/text',
      data: {
        id: id,
        task: task
      },
      success: function(data) {
        console.log("dsdad");
        if (!data['success']){
          window.location.href = "/admin/login/";
        }
          window.location.reload();
      }
    });
  });

  $('.status').click(function (event) {
    let button = $(this);
    let id = button.data('id');
    let status = button.attr('aria-pressed');
    // let status = button.attr('aria-pressed','false');
    let result = status ? 1 : 0;
    $.ajax({
      type: 'POST',
      url: 'update/status',
      data: {
        id: id,
        status: result
      },
      success: function (data) {
        if (!data['success']){
          window.location.href = "/admin/login/";
        }
      }
    });
  });

  function mySort(field, dir) {

    let urlParams = new URLSearchParams(window.location.search);
    let myhref = '';

    if (urlParams.has('page')) {
      let pageProp = urlParams.get('page');
      myhref = '?page=' + pageProp + '&' + field + '=' + dir;
    } else {
      myhref = '?' + field + '=' + dir;
    }
    window.location.href = myhref;
  }
</script>
</body>
</html>
