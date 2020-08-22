# Sistem Informasi Nilai Siswa

Aplikasi berbasis website yang dapat melakukan penginputan nilai raport siswa sampai cetak raport

### Prerequisites

Pastikan anda sudah menginstall aplikasi pendukung yang tertera dibawah ini agar website bisa digunakan

```
Xampp versi 7.4.3 - untuk database dan PHP
composer - untuk instalasi laravel

```

### Installing

setelah clone, akses folder project menggunakan command prompt lalu ikuti langkah dibawah ini

buat dulu file .env dengan mengetikan:

```
copy .env-example .env
```

akses file .env dan atur database sesuai kebutuhan anda

```
...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username_database
DB_PASSWORD=password_database
....
```

generate key terlebih dahulu dengan mengetikan:

```
php artisan key:generate
```

migrate beserta data dummy agar bisa akses ke admin dengan mengertikan:

```
php artisan migrate --seed
```

jika tidak ada error jalankan website dengan mengetik:

```
php artisan serv
```

akses website pada browser anda misal chrome dengan alamat website localhost

```
http://localhost:8000
```

## Deployment

Upcoming.

## Built With

* [Laravel 7](https://laravel.com/) - The web framework used

## Contributing

Upcoming.


## Authors

* **Muhammad Meidy Fachreza** - *Initial work* - [MMeidyF](https://github.com/PurpleBooth)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc
