<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'room_type_id',
        'status',
        'reservation_date',
        'reservation_start_time',
        'reservation_end_time',
        'user_id',

    ];


    protected $casts = [
        'reservation_date' => 'datetime:Y-m-d H:i:s',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ReservationCategory::class);
    }

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);

    }
}
