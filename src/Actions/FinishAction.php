<?php
namespace Htmlacademy\Actions;

class FinishAction extends Action {
    public static function getName(): string {
        return "Завершить";
    }
    public static function getInternalName(): string {
        return "finish";
    }
    public static function checkUserAccess(int $userId, string $role, AvailableActions $strategy): bool {
        return $userId === $strategy->getUserId() && $strategy->getStatus() === AvailableActions::STATUS_PROCESSING;
    }
}
