<?php
use Htmlacademy\Actions\AvailableActions;
use Htmlacademy\Actions\AcceptAction;
use Htmlacademy\Actions\CancelAction;
use Htmlacademy\Actions\FinishAction;
use Htmlacademy\Actions\RefuseAction;
use Htmlacademy\Actions\RespondAction;
use Htmlacademy\Actions\ChatAction;

require_once "vendor/autoload.php";

$strategy = new AvailableActions(AvailableActions::STATUS_NEW, 1, null, '2019-12-22');
print("Тест статусов<br>");
var_dump($strategy->getNextStatus(AcceptAction::class) === AvailableActions::STATUS_PROCESSING);
var_dump($strategy->getNextStatus(CancelAction::class) === AvailableActions::STATUS_CANCELED);
var_dump($strategy->getNextStatus(RefuseAction::class) === AvailableActions::STATUS_FAILED);
var_dump($strategy->getNextStatus(FinishAction::class) === AvailableActions::STATUS_FINISHED);
print("<br>");

print("Тест действий для пользователя с новым заданием<br>");
var_dump($strategy->getAvailableActions(1, AvailableActions::OWNER) === [AcceptAction::class, CancelAction::class]);
var_dump($strategy->getAvailableActions(2, AvailableActions::PERFORMER) === [RespondAction::class]);
var_dump($strategy->getAvailableActions(2, AvailableActions::OTHER) === []);
print("<br>");

print("Тест действий для заданий в работе<br>");
$strategy = new AvailableActions(AvailableActions::STATUS_PROCESSING, 1 , 2, '2019-12-22');
var_dump($strategy->getAvailableActions(1, AvailableActions::OWNER) === [FinishAction::class, ChatAction::class]);
var_dump($strategy->getAvailableActions(2, AvailableActions::PERFORMER) === [RefuseAction::class, ChatAction::class]);
print("<br>");

print("Тест действий для проваленных заданий<br>");
$strategy = new AvailableActions(AvailableActions::STATUS_FAILED, 1 , 2, '2019-12-23');
var_dump($strategy->getAvailableActions(1, AvailableActions::OWNER) === []);
var_dump($strategy->getAvailableActions(2, AvailableActions::PERFORMER) === []);
print("<br>");
