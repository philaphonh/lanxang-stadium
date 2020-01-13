<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    // Table Name
    protected $table = 'tbl_schedule';

    // Primary Key
    protected $primaryKey = 'time_id';

    // Auto Increment
    public $incrementing = true;

    // No Timestamps
    public $timestamps = false;
}
