<?php

class IndexController extends Controller
{
    private $errors = [];

    public function __construct()
    {
        parent::__construct();
        $this->model = new Task();
    }

    function index()
    {
        $data = [];

        if (isset($_POST['submit'])) {

            $name = htmlspecialchars(stripslashes($_POST['name']));
            $email = htmlspecialchars(stripslashes($_POST['email']));
            $task = htmlspecialchars(stripslashes($_POST['task']));

            if ($this->model->isEmpty($name)) {
                $this->errors[] = 'Поле "Имя" обязательно для заполнения';
            }

            if ($this->model->isEmpty($email)) {
                $this->errors[] = 'Поле "Email" обязательно для заполнения';
            } else {
                if (!preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $email)) {
                    $this->errors[] = 'Поле "Email" некорректный';
                }
            }

            if ($this->model->isEmpty($task)) {
                $this->errors[] = 'Поле "Задача" обязательно для заполнения';
            }

            if (!count($this->errors)) {
                if ($this->model->addTask($name, $email, $task)) {
                    setcookie('success', true);
                    $this->redirect();
                } else {
                    $this->errors[] = 'Ошибка добавления';
                }
            }

        }


        if (isset($_GET['name'])) {
            $getSort = htmlspecialchars(stripslashes($_GET['name']));
            $getParam = 'name';
        } elseif (isset($_GET['status'])) {
            $getSort = htmlspecialchars(stripslashes($_GET['status']));
            $getParam = 'status';
        } elseif (isset($_GET['email'])) {
            $getSort = htmlspecialchars(stripslashes($_GET['email']));
            $getParam = 'email';
        } else {
            $getSort = false;
            $getParam = false;
        }

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            $data['tasks'] = $this->model->getTasks($page, $getSort, $getParam);
            $data['page'] = $this->model->Pagination($page, $getSort, $getParam);
            $data['active_link'] = $page;
        } else {
            $data['tasks'] = $this->model->getTasks(1, $getSort, $getParam);
            $data['page'] = $this->model->Pagination(1, $getSort, $getParam);
            $data['active_link'] = 1;
        }

        if (AdminController::isAdmin()) {
            $data['admin'] = true;
        }

        if (isset($_COOKIE['success']) && $_COOKIE['success']) {
            $data['success'] = true;
            setcookie('success', false);
        }

        $data['errors'] = $this->errors;

        $data['action'] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $this->view->generate('main.php', $data);

    }

    public function actionUpdateTaskText()
    {

        if (AdminController::isAdmin()) {
            if (isset($_POST)) {

                $id = htmlspecialchars(stripslashes($_POST['id']));
                $task = htmlspecialchars(stripslashes($_POST['task']));

                if (!$this->model->isEmpty($task)) {
                    $this->model->updateText($id, $task);
                }
            }
            echo json_encode(['success' => true], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['success' => false], JSON_UNESCAPED_UNICODE);
        }

    }

    public function actionUpdateTaskStatus()
    {

        if (AdminController::isAdmin()) {

            if (isset($_POST)) {

                $id = htmlspecialchars(stripslashes($_POST['id']));
                $status = htmlspecialchars(stripslashes($_POST['status']));

                $this->model->updateStatus($id, $status);
            }
        } else {
            echo json_encode(['success' => false], JSON_UNESCAPED_UNICODE);
        }
    }

    private function redirect()
    {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    }

}
