<?php
namespace Htmlacademy\Actions;

class RespondAction extends Action {
    public static function getName(): string {
        return "Откликнуться";
    }
    public static function getInternalName(): string {
        return "respond";
    }
    public static function checkUserAccess(int $userId, string $role, AvailableActions $strategy): bool {
        return $strategy->getStatus() === AvailableActions::STATUS_NEW && $strategy->getUserId() !== $userId && $role === AvailableActions::PERFORMER;
    }
}
