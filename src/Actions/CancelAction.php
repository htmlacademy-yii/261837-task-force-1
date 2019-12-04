<?php
namespace Htmlacademy\Actions;

class CancelAction extends Action {
    public static function getName(): string {
        return "Отменить";
    }
    public static function getInternalName(): string {
        return "cancel";
    }
    public static function checkUserAccess(int $userId, string $role, AvailableActions $strategy): bool {
        return $userId === $strategy->getUserId() && $strategy->getStatus() === AvailableActions::STATUS_NEW;
    }
}
