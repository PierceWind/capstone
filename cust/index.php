<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'functions.php';
$pdo = pdo_connect_mysql();

$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
include $page . '.php';
?>
