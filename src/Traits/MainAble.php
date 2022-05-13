<?php

namespace Package\Kennofizet\DevicesOsUser\Traits;

use Package\Kennofizet\DevicesOsUser\Model\UserBrowserTotal;
use Package\Kennofizet\DevicesOsUser\Model\UserCountryTotal;
use Package\Kennofizet\DevicesOsUser\Model\UserDevicesTotal;
use Package\Kennofizet\DevicesOsUser\Model\UserDevicesToken;
use Package\Kennofizet\DevicesOsUser\Model\UserLocation;
use Package\Kennofizet\DevicesOsUser\Model\UserCdbDetail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use hisorange\BrowserDetect\Parser as Browser;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Str;
use Illuminate\Http\Response;


trait MainAble
{
    public function logined()
    {
        $ip = request()->ip();
        $position = Location::get($ip);
        $name_browser = Browser::browserFamily();
        $flat_form = Browser::platformName();
        $is_mobile = Browser::isMobile();

        $this->saveUserBrowserTotal($name_browser);

        $this->saveUserCountryTotal($position);

        $this->saveUserDevicesTotal($flat_form);

        $this->saveUserCdbDetail($position,$flat_form,$name_browser,$ip,$is_mobile);
        
    }

    public function listLogined($paginate=5,$page=1)
    {
        $user_id = $this->id;
        $get_data = UserCdbDetail::where('user_id',$user_id)->orderBy('id','DESC')->with('country')->with('device')->with('browser')->paginate($paginate,['*'],'page',$page)->toJson();
        
        return json_decode($get_data);
    }

    public function saveUserDevice($ip,$id_country,$id_device,$id_browser,$user_id,$is_mobile)
    {
        $check = UserDevicesToken::where('user_id',$user_id)->where('secret_id',$ip)->where('device',$id_device)->where('country',$id_country)->where('browser',$id_browser)->where('is_mobile',$is_mobile)->first();

        if (!empty($check)) {
            $check->total_time = (int)$check->total_time + 1;
            $check->update();
        }else{
            $new = new UserDevicesToken;
            $new->user_id = $user_id;
            $new->secret_id = $ip;
            $new->secret_token = "Token";
            $new->total_time = 1;
            $new->device = $id_device;
            $new->country = $id_country;
            $new->browser = $id_browser;
            $new->is_mobile = $is_mobile;
            $new->save();
        }

    }

    public function saveUserCdbDetail($location,$flat_form,$name_browser,$ip,$is_mobile)
    {
        $save = true;
        $user_id = $this->id;
        if ($location) {
            $address = $location->countryName . "/" . $location->regionName . "/" . $location->cityName . "/Code:" . $location->postalCode;
        } else {
            $address = "DarkDark";
        }


        if ($location) {
            $country_code = $location->countryCode;
        } else {
            $country_code = "darkdark";
        }
        $code_country = $country_code;
        $check_country = UserCountryTotal::where('code',$code_country)->first();
        if (!empty($check_country)) {
            $id_country = $check_country->id;
        }else{
            $save = false;
        }


        $code_device = Str::slug($flat_form, '-');
        $check_device = UserDevicesTotal::where('code',$code_device)->first();
        if (!empty($check_device)) {
            $id_device = $check_device->id;
        }else{
            $save = false;
        }


        $code_browser = Str::slug($name_browser, '-');
        $check_browser = UserBrowserTotal::where('code',$code_browser)->first();
        if (!empty($check_browser)) {
            $id_browser = $check_browser->id;
        }else{
            $save = false;
        }

        if ($save) {
            $new = new UserCdbDetail;
            $new->user_id = $user_id;
            $new->address = $address;
            $new->id_country = $id_country;
            $new->id_device = $id_device;
            $new->id_browser = $id_browser;
            $new->save();

            $this->saveUserDevice($ip,$id_country,$id_device,$id_browser,$user_id,$is_mobile);
        }

    }
    public function saveUserDevicesTotal($name)
    {
        $code = Str::slug($name, '-');
        $check = UserDevicesTotal::where('code',$code)->first();
        if (!empty($check)) {
            $new_total = (int)$check->total_time + 1;
            $new = false;
        }else{
            $new_total = 1;
            $new = true;
        }
        if ($new) {
            $new_browser_total = new UserDevicesTotal;
            $new_browser_total->name = $name;
            $new_browser_total->code = $code;
            $new_browser_total->total_time = $new_total;
            $new_browser_total->save();
        }else{
            $update_browser_total = $check;
            $update_browser_total->total_time = $new_total;
            $update_browser_total->update();
        }
    }
    public function saveUserCountryTotal($location)
    {
        if ($location) {
            $country_name = $location->countryName;
            $country_code = $location->countryCode;
        } else {
            $country_name = "DarkDark";
            $country_code = "darkdark";
        }
        $code = $country_code;
        $name = $country_name;
        $check = UserCountryTotal::where('code',$code)->first();
        if (!empty($check)) {
            $new_total = (int)$check->total_time + 1;
            $new = false;
        }else{
            $new_total = 1;
            $new = true;
        }
        if ($new) {
            $new_browser_total = new UserCountryTotal;
            $new_browser_total->name = $name;
            $new_browser_total->code = $code;
            $new_browser_total->total_time = $new_total;
            $new_browser_total->save();
        }else{
            $update_browser_total = $check;
            $update_browser_total->total_time = $new_total;
            $update_browser_total->update();
        }
    }
    public function saveUserBrowserTotal($name)
    {
        $code = Str::slug($name, '-');
        $check = UserBrowserTotal::where('code',$code)->first();
        if (!empty($check)) {
            $new_total = (int)$check->total_time + 1;
            $new = false;
        }else{
            $new_total = 1;
            $new = true;
        }
        if ($new) {
            $new_browser_total = new UserBrowserTotal;
            $new_browser_total->name = $name;
            $new_browser_total->code = $code;
            $new_browser_total->total_time = $new_total;
            $new_browser_total->save();
        }else{
            $update_browser_total = $check;
            $update_browser_total->total_time = $new_total;
            $update_browser_total->update();
        }
    }
}
