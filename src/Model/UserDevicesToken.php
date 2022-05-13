<?php

namespace Package\Kennofizet\DevicesOsUser\Model;

use Illuminate\Database\Eloquent\Model;

class UserDevicesToken extends Model
{
    protected $table = "user_devices_token";
    public $timestamps = true;
    protected $fillable = ['user_id', 'secret_id', 'secret_token', 'total_time', 'device', 'country', 'browser', 'is_mobile'];
}
