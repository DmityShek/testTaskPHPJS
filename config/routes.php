<?php
return array(

    // пользователь
    'admin/login' => 'AdminController/actionLogin',
    'admin/logout' => 'AdminController/actionLogout',
    'update/text' => 'IndexController/actionUpdateTaskText',
    'update/status' => 'IndexController/actionUpdateTaskStatus',

		//главная
		'^$' => 'IndexController/index',
		'^[?]page=([0-9]+)$' => 'IndexController/index',
		'^[?](\w{4,6})=(\w{3,4})$'  => 'IndexController/index',

		'^[?]page=([0-9]+)(&)(\w{4,6})=(\w{3,4})$' => 'IndexController/index',
);
