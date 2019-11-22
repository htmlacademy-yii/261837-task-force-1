<?php
namespace Htmlacademy\Actions;

class AcceptAction extends Action {
    public static function getName() {
        return "Принять";
    }
    public static function getInternalName() {
        return "accept";
    }
    public static function checkUserAccess($userId, $role, $strategy) {
        return $userId === $strategy->getUserId() && $strategy->getStatus() === AvailableActions::STATUS_NEW;
    }
}
