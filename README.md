## ShopTest
這是一個使用Laravel框架建立簡單電子商務網站的Side project。

## 功能
- 註冊、登入
- FB登入(需要設定過才能使用)
- reCaptcha(需要設定過才能使用)
### 使用者功能
- 商品瀏覽和查詢
- 購物車功能
- 查看購買紀錄
- 修改個人資料
- 使用綠界金流結帳(需要設定過才能使用)
### 管理者功能
- 管理會員
- 管理商品
- 管理類別
- 管理交易紀錄
- 管理公告(發送公告後透過redis異步執行，寄送Email給所有使用者)

## 安裝
1.	Clone
2.	複製BackUpImg裡面的兩個資料夾放到storage\app\public
3.	執行 `php artisan storage:link`
4.	複製 .env.example 文件並將其重命名為 .env
5.	修改 .env 文件中的資料庫連接設置
6.	執行 `composer install`
7.	執行 `php artisan key:generate` 生成金鑰
8.	執行 `php artisan migrate` 創建資料表
9.	執行 `php artisan db:seed --class=AllSeede` 將示範資料填充到資料庫中
10.	執行 `php artisan serve` 啟動開發伺服器
11.	執行 `php artisan queue:work` 執行Queue

## 使用
1.	在瀏覽器中打開 http://localhost:8000
2.	使用者瀏覽和查詢商品，將商品加到購物車，並通過綠界金流刷卡結帳
3.	管理者可管理會員、商品、類別、交易紀錄、管理公告(發送公告後透過redis異步執行，寄送Email給所有使用者)

## 測試用帳號
- admin帳號  
  信箱:admintest@gmail.com  
  密碼:adminroot
- user帳號  
  信箱:usertest@gmail.com  
  密碼:user1234
