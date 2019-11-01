<?php

/**
 * Контроллер AdminController
 */
class AdminController extends Controller
{

	private $errors = [];

	public function __construct()
	{
		parent::__construct();
		$this->model = new Admin(); 
	}

	public function actionLogin()
	{

		if ($this::isAdmin()) {
			header('Location: /');
		}
		
		if (isset($_POST['submit'])) {
			$name = htmlspecialchars(stripslashes($_POST['name']));
			$password = htmlspecialchars(stripslashes($_POST['password']));
			
			if ($this->model->isEmpty($name)) {
				$this->errors[] = 'Поле "Имя" обязательно для заполнения';
			}

			if ($this->model->isEmpty($password)) {
				$this->errors[] = 'Поле "Пароль" обязательно для заполнения';
			}

			if (!count($this->errors)) {

				$userId = $this->model->checkUserData($name, $password);

				if ($userId) {
					$_SESSION['admin'] = $userId;
					header('Location: /');
				} else {
					$this->errors[] = 'Неправильные данные для входа на сайт';
				}
			}
			$data['name'] = $name;
		}
		$data['errors'] = $this->errors;
		$this->view->generate('admin/index.php', $data);
	}

	//удаление сессии
	public static function actionLogout()
	{
//		session_start();
		if (isset($_SESSION['admin'])) {
			unset($_SESSION['admin']);
			session_destroy();
		}
        header('Location: /');
	}

	public static function isAdmin()
	{
		if (isset($_SESSION['admin'])) {
			return true;
		}
	}

}
