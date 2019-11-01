<?php
class Router{
	private $routes;

	public function __construct() {
		$routesPath = ROOT . '\config\routes.php';
		$this->routes = include($routesPath);
	}

	private function getURI() {
		if (!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}
	public function run() {
		// Получаем строку запроса
		$uri = $this->getURI();
		$parameters = [];
		// Проверяем наличие такого запроса в массиве маршрутов (routes.php)
		foreach ($this->routes as $uriPattern => $path) {

			if (preg_match("~$uriPattern~", $uri)) {

				// Получаем внутренний путь из внешнего согласно правилу.
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
				// Определить контроллер, метод, параметры
				$segments = explode('/', $internalRoute);
				$controller = $segments[0];
				$action = $segments[1];

				if (!empty($segments[2])) {
					$parameters[] = $segments[2];
				}

				$controller = new $controller;
				$controller->$action(...$parameters);
			}
		}

	}

}
