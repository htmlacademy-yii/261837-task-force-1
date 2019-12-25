<?php
namespace Htmlacademy\Actions;

class AcceptAction extends Action {
    public static function getName(): string {
        return "Принять";
    }
    public static function getInternalName(): string {
        return "accept";
    }
    public static function checkUserAccess(int $userId, string $role, AvailableActions $strategy): bool {
        return $userId === $strategy->getUserId() && $strategy->getStatus() === AvailableActions::STATUS_NEW;
    }
}
