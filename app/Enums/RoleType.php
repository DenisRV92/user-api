<?php

namespace App\Enums;

enum RoleType: int
{
    case Manager = 1;
    case User = 2;


    public static function fromString($type): RoleType
    {
        return match (strtolower($type)) {
            'manager' => RoleType::Manager,
            'user' => RoleType::User,
            default => RoleType::User,
        };
    }
}
