<?php

namespace App\Enum;

class OrderEnum
{
    public const paid_status = "PAID";
    public const canceled_status = "CANCELED";
    public const pending_status = "PENDING";

    public static function getStatus() : array {
        return [
            self::paid_status,
            self::pending_status,
            self::canceled_status,
        ];
    }

    public static function getStatesKeyValue() : array {
        return [
            ['key' => self::paid_status, 'value' => __('words.order-paid-status')],
            ['key' => self::pending_status, 'value' => __('words.order-pending-status')],
            ['key' => self::canceled_status, 'value' => __('words.order-canceled-status')],
        ];
    }
}
