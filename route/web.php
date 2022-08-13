<?php

use App\Controller\HomeController;
use App\Controller\AdminController;

Router::add('GET', '/', HomeController::class, 'index');
Router::add('GET', '/task/add', HomeController::class, 'addTaskView');
Router::add('POST', '/task/add', HomeController::class, 'saveTask');

Router::add('GET', '/admin', AdminController::class, 'loginView');
Router::add('POST', '/admin', AdminController::class, 'login');
Router::add('POST', '/admin/logout', AdminController::class, 'logout');

Router::add('GET', '/task/edit', AdminController::class, 'updateTaskView');
Router::add('POST', '/task/edit', AdminController::class, 'updateTask');
