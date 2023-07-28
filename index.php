<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

require __DIR__ . "/env.php";
require __DIR__ . "/src/MyDataBase.php";
require __DIR__ . "/src/BooksGateway.php";
require __DIR__ . "/src/BooksController.php";
require __DIR__ . "/src/ErrorHandler.php";

set_exception_handler("ErrorHandler::handleException");

$foo = [];
$parts = explode("/", $_SERVER["REQUEST_URI"]);
if (!in_array("books", $parts)) {
    http_response_code(404);
    exit;
}
$key = array_search("books", $parts) + 1;
if (array_key_exists($key, $parts)) {
    $id = $parts[$key];
} else {
    $id = null;
}

$env = new Env();
$database = new MyDataBase($env->host, $env->dbname, $env->user, $env->password, $env->port);
$gateway = new BooksGateway($database);

$controller = new BooksController($gateway);

$controller->processRequest($_SERVER["REQUEST_METHOD"], $id);