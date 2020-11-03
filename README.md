# Sistem Informasi Nilai Siswa

Aplikasi berbasis website yang dapat melakukan penginputan nilai raport siswa sampai cetak raport

### Persiapan

Pastikan anda sudah menginstall aplikasi pendukung yang tertera dibawah ini agar website bisa digunakan

```
Xampp versi 7.4.3 - untuk database dan PHP
composer - untuk instalasi laravel

```

### Instalasi

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

## Dibuat dengan

* [Laravel 7](https://laravel.com/) - Framework yang digunakan


## Penjelasan Singkat

bagian controller
```
#fungsi
index = menampilkan halaman utama dari fitur yang diakses 
create = mengarahkan ke halaman formulir tambah data
store = proses penyimpanan tambah data dari formulir tambah data ke dalam database
show = menampilkan ke halaman yang menampilkan data yang dipilih secara detail 
edit = mengarahkan ke halaman formulir ubah data
update = proses perbarui data yang ada di database dari formulir ubah data
destroy = proses hapus data yang dipilih

#di dalam fungsi
$request->all() = mengekstrak seluruh data yang diisi dari halaman formulir
->create() = proses simpan data baru ke dalam database yang sumber datanya dari halaman formulir
->findOrFail($id) = proses pencarian data berdasarkan id, jika tidak ditemukan maka tampilan akan menampilan status 404 yang artinya halaman tidak ada
->find($id) = proses pencarian data berdasarkan id
->delete() = proses penghapusan data di database
->first() = mengambil data pada baris pertama dari sebuah tabel pada database
->all() = mengambil seluruh data yang ada pada tabel yang diinginkan
```
