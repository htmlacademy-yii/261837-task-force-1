<?php
namespace Htmlacademy\Actions;

abstract class Action {
	abstract public static function getName();
    abstract public static function getInternalName();
    abstract public static function checkUserAccess($userId, $role, $strategy);
}
