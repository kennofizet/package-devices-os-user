<?php

namespace Package\Kennofizet\DevicesOsUser\Model;

use Illuminate\Database\Eloquent\Model;

class UserBrowserTotal extends Model
{
    protected $table = "user_browser_total";
    public $timestamps = true;
    protected $fillable = ['id_browser', 'total_time'];
}
