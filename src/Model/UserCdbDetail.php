<?php

namespace Package\Kennofizet\DevicesOsUser\Model;

use Illuminate\Database\Eloquent\Model;
use Package\Kennofizet\DevicesOsUser\Model\UserBrowserTotal as Browser;
use Package\Kennofizet\DevicesOsUser\Model\UserCountryTotal as Country;
use Package\Kennofizet\DevicesOsUser\Model\UserDevicesTotal as Device;

class UserCdbDetail extends Model
{
    protected $table = "user_cdb_detail";
    public $timestamps = true;
    protected $fillable = ['user_id', 'address', 'id_country', 'id_device', 'id_browser'];

    public function country()
    {
        return $this->belongsTo("Package\Kennofizet\DevicesOsUser\Model\UserCountryTotal",'id_country');
    }

    public function browser()
    {
        return $this->belongsTo("Package\Kennofizet\DevicesOsUser\Model\UserBrowserTotal",'id_browser');
    }

    public function device()
    {
        return $this->belongsTo("Package\Kennofizet\DevicesOsUser\Model\UserDevicesTotal",'id_device');
    }
}
