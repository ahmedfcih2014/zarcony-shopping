<?php

namespace App\Enum;

class UserEnum {
    public const admin_role = 'Admin';
    public const client_role = 'Client';

    public static function getRoles() : array {
        return [
            self::admin_role,
            self::client_role,
        ];
    }
}
