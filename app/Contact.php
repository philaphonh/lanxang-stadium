<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    // Table Name
    protected $table = 'tbl_contact';

    // Primary Key
    protected $primaryKey = 'contact_id';

    // Auto Increment
    public $incrementing = true;

    // No timestamps
    public $timestamps = false;
}
