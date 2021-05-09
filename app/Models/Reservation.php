<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'room_type',
        'reservation_date',
        'reservation_start_time',
        'reservation_end_time',
        'user_id'
    ];

    protected $appends = [
        'readable_reservation_time',
        'readable_creation_date'
    ];

    public function getReadableReservationTimeAttribute(): string
    {
        $reservationStart = Carbon::parse($this->reservation_start_time)->format('H:i');
        $reservationEnd  = Carbon::parse($this->reservation_end_time)->format('H:i');
        return "{$this->reservation_date} {$reservationStart} - {$reservationEnd}";
    }

    public function getReadableCreationDateAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    public function category()
    {
        return $this->belongsTo(ReservationCategory::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);

    }
}
