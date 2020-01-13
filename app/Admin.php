<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class Admin extends Model
{
    use HasApiTokens;
    //
    // Table Name
    protected $table = 'tbl_admin';

    // Primary Key
    protected $primaryKey = 'id';

    // Auto Increment
    public $incrementing = true;

    // No timestamps
    public $timestamps = false;

    public function setPasswordAttribute($password) {
        $this->attributes['admin_password'] = Hash::make($password);
    }
}
