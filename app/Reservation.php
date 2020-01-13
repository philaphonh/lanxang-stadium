<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    // Table Name
    protected $table = 'tbl_reservation';

    // Primary Key
    protected $primaryKey = 'reservation_id';

    // Auto Increment
    public $incrementing = true;

    // No Timestamps
    public $timestamps = false;

    // Default Value for is_checked_in
    protected $attributes = [
        'is_checked_in' => false
    ];

    // Cast
    protected $casts = [
        'reserve_date' => 'datetime:d/m/y H:i:s',
        'selected_date' => 'date:d/m/y'
    ];
}
