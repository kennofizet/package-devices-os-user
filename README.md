# package-devices-os-user
customer save data source :
  ```
  "hisorange/browser-detect":"*",
  "stevebauman/location":"*"
  ```
install: 
  ```
  composer require kennofizet/devices-os-user
  php artisan migrate
  ```
use :
  ```
  model_user->logined();// dispatch event and job ->logined(request()->header('User-Agent'))
  model_user->listLogined() default per page 5, page 1
  model_user->listLogined(per_page,page)
  ```
model_user:
  ```
  use Package\Kennofizet\DevicesOsUser\Traits\MainAble;
  use MainAble;
  ```
