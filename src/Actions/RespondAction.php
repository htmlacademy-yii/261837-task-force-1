<?php
namespace Htmlacademy\Actions;

class RespondAction extends Action {
    public static function getName() {
        return "Откликнуться";
    }
    public static function getInternalName() {
        return "respond";
    }
    public static function checkUserAccess($userId, $role, $strategy) {
        return $strategy->getStatus() === AvailableActions::STATUS_NEW && $strategy->getUserId() !== $userId && $role === AvailableActions::PERFORMER;
    }
}
