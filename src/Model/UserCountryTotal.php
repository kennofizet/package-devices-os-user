<?php

namespace Package\Kennofizet\DevicesOsUser\Model;

use Illuminate\Database\Eloquent\Model;

class UserCountryTotal extends Model
{
    protected $table = "user_country_total";
    public $timestamps = true;
    protected $fillable = ['id_country', 'total_time'];
}
