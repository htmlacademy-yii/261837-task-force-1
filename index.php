<?php
use Htmlacademy\Task;
require_once "vendor/autoload.php";

$task = new Task(1, 2, date("Y-m-d"));

function sheckTaskError($result, $obj) {
    if (!$result) {
        print($obj->getMessage() . "<br>");
    } else {
        print("Действие выполнено<br>");
    }
}

print("Тест класса Task<br>");
print("Тест действий для Task<br>");

$result1 = $task->setAction("bla-bla-bla");
print($task->getStatus() . "<br>");
sheckTaskError($result1, $task);

$result2 = $task->setAction("approve");
print($task->getStatus() . "<br>");
sheckTaskError($result2, $task);

$result3 = $task->setAction("start");
print($task->getStatus() . "<br>");
sheckTaskError($result3, $task);

$result4 = $task->setAction("approve");
print($task->getStatus() . "<br>");
sheckTaskError($result4, $task);

$result5 = $task->setAction("cancel");
print($task->getStatus() . "<br>");
sheckTaskError($result5, $task);

$result6 = $task->setAction("degree");
print($task->getStatus() . "<br>");
sheckTaskError($result6, $task);

print("Тест других методов класса Task<br>");

print_r($task->getStatuses());
print("<br>");
print_r($task->getActions());
print("<br>");

print($task->getDateEnd() . "<br>");
