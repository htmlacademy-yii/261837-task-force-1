<?php
namespace Htmlacademy\Actions;

class CancelAction extends Action {
    public static function getName() {
        return "Отменить";
    }
    public static function getInternalName() {
        return "cancel";
    }
    public static function checkUserAccess($userId, $role, $strategy) {
        return $userId === $strategy->getUserId() && $strategy->getStatus() === AvailableActions::STATUS_NEW;
    }
}
