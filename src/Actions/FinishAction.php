<?php
namespace Htmlacademy\Actions;

class FinishAction extends Action {
    public static function getName() {
        return "Завершить";
    }
    public static function getInternalName() {
        return "finish";
    }
    public static function checkUserAccess($userId, $role, $strategy) {
        return $userId === $strategy->getUserId() && $strategy->getStatus() === AvailableActions::STATUS_PROCESSING;
    }
}
