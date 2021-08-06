# my-test

-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

### การเริ่มต้นติดตั้งระบบหน้าบ้าน(Frontend)
คุณสามารถเริ่มต้นติดตั้งระบบหน้าบ้านด้วยคำสั่งด้านล่างนี้
```
npm install
```

### เริ่มต้นการทำงานของระบบหน้าบ้าน(Frontend)
คุณสามารถเริ่มต้นการทำงานของระบบหน้าบ้านด้วยคำสั่งด้านล่างนี้
```
npm run serve
```

### Customize frontend configuration
ดูเพิ่มเติมได้ที่ [Configuration Reference](https://cli.vuejs.org/config/).

### การเริ่มต้นและตั้งค่าระบบหลังบ้าน(ฺBackend)
คุณมีไฟล์ PHP Server ให้คุณใน ./backend/action.php
โดยเราได้กำหนดค่า default เริ่มต้นให้ดังนี้ 
```
$servername = "localhost" ;         //Your  server
$username = "root" ;                //Your  username
$password = "" ;                    //Your  password
$dbname = "my_test" ;               //Database name
$tablename = "users_data" ;         //Table name
```
### ฐานข้อมูล MySQL(ฺMySQL database)
คุณมีไฟล์ SQL database ให้คุณใน ./backend/my_test.sql
