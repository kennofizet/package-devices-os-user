# package-devices-os-user
customer save data source :
  ```
  "hisorange/browser-detect":"*",
  "stevebauman/location":"*"
  ```
use :
  ```
  model_user->logined();
  model_user->listLogined() default per page 5, page 1
  model_user->listLogined(per_page,page)
  ```
model_user:
  ```
  use Package\Kennofizet\DevicesOsUser\Traits\MainAble;
  use MainAble;
  ```
