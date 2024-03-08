<?php

header('Content-Type: application/json');

include 'Core/Routes.php';

$routes = new Routes();

$routes->addRoute('/todolist', 'index', 'TodoListController');
$routes->addRoute('/todolist/{id}', 'show', 'TodoListController');
$routes->addRoute('/todolist/store', 'store', 'TodoListController');
$routes->addRoute('/todolist/{id}/update', 'update', 'TodoListController');
$routes->addRoute('/todolist/{id}/delete', 'delete', 'TodoListController');
