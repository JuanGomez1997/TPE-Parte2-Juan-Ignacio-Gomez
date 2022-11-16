<?php
require_once './libs/Router.php';
require_once './app/controllers/book-api.controller.php';
require_once './app/controllers/assessment-api.controller.php';
require_once './app/controllers/genre-api.controller.php';


$router = new Router();


$router->addRoute('books', 'GET', 'ControllerApiBook', 'getBooks');
$router->addRoute('books/:ID', 'GET', 'ControllerApiBook', 'getBook');
$router->addRoute('books/:ID', 'DELETE', 'ControllerApiBook', 'deleteBook');
$router->addRoute('books', 'POST', 'ControllerApiBook', 'addBook');

//----
$router->addRoute('assessment', 'GET', 'ControllerApiAssessment', 'getValuations');
$router->addRoute('assessment/:ID', 'GET', 'ControllerApiAssessment', 'getAssessment');
$router->addRoute('assessment', 'POST', 'ControllerApiAssessment', 'addNewAssessment');
$router->addRoute('assessment/:ID', 'PUT', 'ControllerApiAssessment', 'editAssessment');

//---
$router->addRoute('genre', 'GET', 'controllerGenreBook', 'showGender');
$router->addRoute('genre/:ID', 'GET', 'controllerGenreBook', 'seemoreGenreBook');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);