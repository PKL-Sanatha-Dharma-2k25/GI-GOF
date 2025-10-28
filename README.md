<p align="center"><a href="https://drive.google.com/uc?export=view&id=1JLriGGx8wtegrTS7JGopZrAdrD2mz21s" target="_blank"><img src="https://drive.google.com/uc?export=view&id=1JLriGGx8wtegrTS7JGopZrAdrD2mz21s" width="400" alt="Login Page"></a></p>

## About

Role 0 (all dept kecuali GA ) : 
- username : Ananta 
- password : 112233

Role 1 (Admin/GA) : 
- username : GA 
- password : 112233

Aplikasi digitalisasi form pengadaan/perbaikan untuk department GA berbasis laravel 12, terintegrasi dengan:

- DataTable
- SweetAlert2
- Select2
- Tailwick Templates
- AnimeJs

## Instalation

- Clone ke local
- Buka cmd di directory-nya
- Run ``composer install``
- Run ``npm install``
- Run ``npm install animejs``
- Run ``php artisan key:generate``
- Run ``php artisan migrate``
- Akses langsung di http://localhost/<nama folder project> tanpa harus menggunakan ``php artisan serve``

Note untuk AnimeJs: 
- Setelah konfigurasi animasi animejs, silahkan run sesuai kondisi
- Untuk development, Run ``npm run dev`` lalu refresh page browser
- Untuk production : 
- Run ``npm run build`` 
- Move folder ``/build`` pada folder public, menuju ke root project(nama folder project) eg: ``Template-Laravel12-main``

