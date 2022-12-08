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

    public static function getRolesKeyValue() : array {
        return [
            ['key' => self::admin_role, 'value' => __('words.admin-role')],
            ['key' => self::client_role, 'value' => __('words.client-role')],
        ];
    }
}
