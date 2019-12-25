<?php
namespace Htmlacademy\Actions;

class ChatAction extends Action {
    public static function getName(): string {
        return "Написать сообщение";
    }
    public static function getInternalName(): string {
        return "chat";
    }
    public static function checkUserAccess(int $userId, string $role, AvailableActions $strategy): bool {
        return $strategy->getPerformerId() && in_array($userId, [$strategy->getUserId(), $strategy->getPerformerId()]) && $strategy->getStatus() === AvailableActions::STATUS_PROCESSING;
    }
}
