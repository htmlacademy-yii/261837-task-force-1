<?php
namespace Htmlacademy\Actions;

class RefuseAction extends Action {
    public static function getName() {
        return "Отказаться";
    }
    public static function getInternalName() {
        return "refuse";
    }
    public static function checkUserAccess($userId, $role, $strategy) {
        return $userId === $strategy->getPerformerId() && $strategy->getStatus() === AvailableActions::STATUS_PROCESSING;
    }
}
