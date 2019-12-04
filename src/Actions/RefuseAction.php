<?php
namespace Htmlacademy\Actions;

class RefuseAction extends Action {
    public static function getName(): string {
        return "Отказаться";
    }
    public static function getInternalName(): string {
        return "refuse";
    }
    public static function checkUserAccess(int $userId, string $role, AvailableActions $strategy): bool {
        return $userId === $strategy->getPerformerId() && $strategy->getStatus() === AvailableActions::STATUS_PROCESSING;
    }
}
