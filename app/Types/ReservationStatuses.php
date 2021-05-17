<?php


namespace App\Types;


class ReservationStatuses
{
    const _RESERVED = 'reserved';
    const _CANCELLED = 'cancelled';
    const _PENDING = 'pending';
    const _APPROVED = 'approved';
    const _COMPLETED = 'completed';

    public static function getAllStatuses()
    {
        return [
            self::_RESERVED,
            self::_CANCELLED,
            self::_PENDING,
            self::_APPROVED,
            self::_COMPLETED
        ];
    }
}