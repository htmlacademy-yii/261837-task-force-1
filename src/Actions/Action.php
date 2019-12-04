<?php
namespace Htmlacademy\Actions;

abstract class Action {
	abstract public static function getName(): string;
    abstract public static function getInternalName(): string;
    abstract public static function checkUserAccess(int $userId, string $role, AvailableActions $strategy): bool;
}
