<?php

namespace Package\Kennofizet\DevicesOsUser\Model;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    protected $table = "user_location";
    public $timestamps = true;
    protected $fillable = ['slug', 'name'];
}
