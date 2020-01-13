<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    //
    // Table Name
    protected $table = 'tbl_stadium';

    // Primary Key
    protected $primaryKey = 'stadium_id';

    // Auto Increment
    public $incrementing = true;

    // No Timestamps
    public $timestamps = false;
}
