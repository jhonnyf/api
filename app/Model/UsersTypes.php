<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsersTypes extends Model
{
    protected $primaryKey = 'id';
    protected $fillable   = ['user_type'];
}
