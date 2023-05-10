vidIQ-key-explorer
==

Vidiq Keyword Explorer API Wrapper 

### Getting started
1. install plugin vidiq in browser
2. get Authorization from vidiq browser (firefox or chrome)
```
firefox
- get url `about:devtools-toolbox?id=firefox@vid.io&type=extension&type=extension`
- check/click tab network, reload, domain api.vidiq.com dan file user
- view request header **Authorization**
chrome
- get url `chrome://extensions` and Mode developer is on
- click background page in vidiq
- click tab security, network, reload other tab url youtube and back to first tab
- click secure origins api.vidiq.com name user
- view request header **Authorization**
```
3. Authorization edit in file **inc/config** name *CHANNEL_TOKEN*
4. file data key in excel save in **src** name vidiq or edit file config name *FILE_EXCEL*
5. closed browser (firefox or chrome) connected from vidiq
6. double click vidiq.bat
### Description
1. download PHP 7.3.9 portable and save it in the **lib/** folder with the folder name *php*
2. pause next in check key vidiq 1 second and looping interval 10 data in 2 second then update file config *SLEEP* and *MAX_SLEEP*
### Developer mode
```
require('lib/vidiq.php');
$vidiq = new Vidiq();
$vidiq = $vidiq->init(*text_search*)
```
### Trick limit output console bat desc limit 
1. remove plugin vidiq in browser and chaneel youtube in account vidiq
2. logout dan register account 
3. finish, repeat step Getting started
## Temporary email 
- https://mail.tm/en/
