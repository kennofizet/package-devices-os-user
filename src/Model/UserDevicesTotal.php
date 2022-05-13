<?php

namespace Package\Kennofizet\DevicesOsUser\Model;

use Illuminate\Database\Eloquent\Model;

class UserDevicesTotal extends Model
{
    protected $table = "user_devices_total";
    public $timestamps = true;
    protected $fillable = ['id_device', 'total_time'];
}
