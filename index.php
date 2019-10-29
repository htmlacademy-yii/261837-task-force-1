<?php
use Htmlacademy\Task;
require_once "vendor/autoload.php";

$task = new Task(1, 2, date("Y-m-d"));
print("Тест класса Task<br>");
$task->setAction("start");
$task->setAction("bla-bla-bla");
print($task->getStatus() . "<br>");
$task->setAction("create");
print($task->getStatus() . "<br>");
$task->setAction("start");
print($task->getStatus() . "<br>");
$task->setAction("approve");
print($task->getStatus() . "<br>");
$task->setAction("cancel");
print($task->getStatus() . "<br>");
$task->setAction("degree");
print($task->getStatus() . "<br>");
print_r($task->getStatuses());
print("<br>");
print_r($task->getActions());
print("<br>");
print($task->getDateEnd() . "<br>");
