# Informasi Program

# Instalasi
Jalankan composer
```install
composer install
```
Rename file **[.env.example](https://github.com/HMsyah23/SI_SMAKE/blob/main/.env.example)** menjadi **.env**

Buat Database pada mysql dengan nama surat, Setelah itu import file [surat.sql](https://github.com/HMsyah23/SI_SMAKE/blob/main/surat.sql) kedalaman database surat, lalu ketikan perintah berikut pada console :
```
php artisan key:generate
php artisan serve
```
Username & Password :
```
email : admin@admin.com
password : password
```