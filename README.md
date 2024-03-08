##### LAURINDA-FRAMEWORK

Este projeto tem como objetivo ajudar no desenvolvimento de API REST usando PHP seguindo o padrão MVC.

#### Funções criadas até o momento.

Controllers
Rotas
Models
Validations
FileUpload

#### Sistema de rotas simples e funcional
php
```
include 'Core/Routes.php';

$routes = new Routes();

$routes->addRoute('/todolist', 'index', 'TodoListController');
$routes->addRoute('/todolist/{id}', 'show', 'TodoListController');
$routes->addRoute('/todolist/store', 'store', 'TodoListController');
$routes->addRoute('/todolist/{id}/update', 'update', 'TodoListController');
$routes->addRoute('/todolist/{id}/delete', 'delete', 'TodoListController');
```
