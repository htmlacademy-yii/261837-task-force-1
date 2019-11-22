<?php
namespace Htmlacademy\Actions;

class ChatAction extends Action {
    public static function getName() {
        return "Написать сообщение";
    }
    public static function getInternalName() {
        return "chat";
    }
    public static function checkUserAccess($userId, $role, $strategy) {
        return $strategy->getPerformerId() && in_array($userId, [$strategy->getUserId(), $strategy->getPerformerId()]) && $strategy->getStatus() === AvailableActions::STATUS_PROCESSING;
    }
}
