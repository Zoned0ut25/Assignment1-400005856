<?php
  require 'autoloader.php';
  require 'config.php';

$IndexController = new IndexController();

// dont have a function in your class called index
$IndexController->start();
?>
