|   INDIRA ALINE    |   TI.20 A.1   |
|-------------------|---------------|
|  Pemrograman Web  |  Praktikum 11 |

# Lab11Web

Dalam praktikum ini akan membuat program sederhana menggunakan Framework Codeigniter 4.

# Langkah - langkah praktikum

## 1). Mengaktifkan ekstentsi tersebut, melalu XAMPP Control Panel, pada bagian apache klik Config -> PHP.ini

![xampp](img/mysql_server.png)

## 2). Pada bagian extention, hilangkan tanda ; (titik koma) pada ekstensi yang akan diaktifkan. Kemudian simpan kembali filenya dan restart Apache web server.

![extension](img/extension.png)

## 3). Instalasi Codeigniter 4
Untuk melakukan instalasi Codeigniter 4 dapat dilakukan dengan dua cara, yaitu cara manual dan menggunakan composer. Pada praktikum ini kita menggunakan cara manual.
Buka browser dengan alamat http://localhost/Lab11Web/lab11_php_ci/ci4/public/

![install](img/instalasi.png)

## 4). Menjalankan CLI (Command Line Interface)
Menjalankan CLI (Command Line Interface) Codeigniter 4 menyediakan CLI untuk mempermudah proses development. Untuk mengakses CLI buka terminal/command prompt.

![CLI](img/run-cli.png)

Arahkan lokasi direktori sesuai dengan direktori kerja project dibuat
(xampp/htdocs/Lab11Web/lab11_php_ci/ci4)
Perintah yang dapat dijalankan untuk memanggil CLI Codeigniter adalah:
```CLI
php spark
```

![spark](img/php_spark.png)

## 5). Mengaktifkan Mode Debugging
Codeigniter 4 menyediakan fitur debugging untuk memudahkan developer untuk mengetahui pesan error apabila terjadi kesalahan dalam membuat kode program. Secara default fitur ini belum aktif. Ketika terjadi error pada aplikasi akan ditampilkan pesan kesalahan seperti berikut.

![debug](img/debugging.png)

Semua jenis error akan ditampilkan sama. Untuk memudahkan mengetahui jenis errornya, maka perlu diaktifkan mode debugging dengan mengubah nilai konfigurasi pada environment variable CI_ENVIRONMENT menjadi development.

![env](img/env.png)

Ubah nama file env menjadi .env kemudian buka file tersebut dan ubah nilai variable CI_ENVIRONMENT menjadi development.

![parse](img/parse.png)

Contoh error yang terjadi. Untuk mencoba error tersebut, ubah kode pada file app/Controller/Home.php hilangkan titik koma pada akhir kode.

![error](img/home.png)

## 6). Membuat Routes Baru
Tambahkan code pada routes.php
```php
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
```

![routes](img/routescode.png)

Untuk mengetahui route yang ditambahkan sudah benar, buka CLI dan jalankan
perintah berikut.
```CLI
php spark routes
```

![cmd](img/routes.png)

Selanjutnya coba akses route yang telah dibuat dengan mengakses alamat url http://localhost:8080/about

![about](img/404.png)

Ketika diakses akan mucul tampilan error 404 file not found, itu artinya file/page tersebut tidak ada. Untuk dapat mengakses halaman tersebut, harus dibuat terlebih dahulu Contoller yang sesuai dengan routing yang dibuat yaitu Contoller Page.

## 7). Membuat Controller
Selanjutnya adalah membuat Controller Page. Buat file baru dengan nama page.php pada direktori Controller kemudian isi kodenya seperti berikut.

```php
<?php

namespace App\Controllers;

class Page extends BaseController
{
    public function about()
    {
        echo "Ini halaman About";
    }
    public function contact()
    {
        echo "Ini halaman Contact";
    }
    public function faqs()
    {
        echo "Ini halaman FAQ";
    }
}
```

Berikut hasil run

![controller](img/about1.png)

## 8). Auto Routing
Secara default fitur autoroute pada Codeiginiter sudah aktif. Untuk mengubah status autoroute dapat mengubah nilai variabelnya. Untuk menonaktifkan ubah nilai true menjadi false.

```php
$routes->setAutoRoute(true);
```
Tambahkan method baru pada Controller Page seperti berikut.

```php
  public function tos()
    {
        echo "ini halaman Term of Services";
    }
```

Method ini belum ada pada routing, sehingga cara mengaksesnya dengan menggunakan
alamat:http://localhost:8080/page/tos

![tos](img/page.png)

## 9). Membuat View
Selanjutnya adalam membuat view untuk tampilan web agar lebih menarik. Buat file baru dengan nama about.php pada direktori view (app/view/about.php) kemudian isi kodenya seperti berikut.

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
</head>
<body>
    <h1><?= $title; ?></h1>
    <hr>
    <p><?= $content; ?></p>
</body>
</html>
```

Ubah method about pada class Controller Page menjadi seperti berikut:

```php
public function about()
    {
        return view('about', [
            'title' => 'Halaman About',
            'content' => 'Ini adalah halaman about yang menjelaskan tentang isi halaman ini.'
        ]);
    }
```

Refresh halaman tersebut

![about](img/about2.png)

## 10). Membuat Layout Web dengan CSS
Pada dasarnya layout web dengan css dapat diimplamentasikan dengan mudah pada codeigniter. Yang perlu diketahui adalah, pada Codeigniter 4 file yang menyimpan asset css dan javascript terletak pada direktori public.

Buat file css pada direktori public dengan nama style.css (copy file dari praktikum lab4_layout. Kita akan gunakan layout yang pernah dibuat pada praktikum 4.

![folder](img/copy.png)

Kemudian buat folder template pada direktori view kemudian buat file header.php dan footer.php

File app/views/template/header.php

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('/style.css');?>">
</head>
<body>
    <div id="container">
    <header>
        <h1>Layout Sederhana</h1>
    </header>
    <nav>
        <a href="<?= base_url('/');?>" class="active">Home</a>
        <a href="<?= base_url('/artikel');?>">Artikel</a>
        <a href="<?= base_url('/about');?>">About</a>
        <a href="<?= base_url('/contact');?>">Kontak</a>
    </nav>
<section id="wrapper">
    <section id="main">

```

File app/views/template/footer.php
```php
    </section>
    <aside id="sidebar">
        <div class="widget-box">
            <h3 class="title">Widget Header</h3>
            <ul>
                <li><a href="#">Widget Link</a></li>
                <li><a href="#">Widget Link</a></li>
            </ul>
        </div>
        <div class="widget-box">
            <h3 class="title">Widget Text</h3>
            <p>Vestibulum lorem elit, iaculis in nisl volutpat, malesuada
tincidunt arcu. Proin in leo fringilla, vestibulum mi porta, faucibus felis.
Integer pharetra est nunc, nec pretium nunc pretium ac.</p>
        </div>
    </aside>
</section>
<footer>
    <p>&copy; 2022 - Universitas Pelita Bangsa</p>
</footer>
</div>
</body>
</html>
```

Kemudian ubah file app/view/about.php seperti berikut.

```php
<?= $this->include('template/header'); ?>

<h1><?= $title; ?></h1>
<hr>
<p><?= $content; ?></p>

<?= $this->include('template/footer'); ?>
```
Refresh halaman tersebut

![hasil](img/css.png)

# Praktikum 12 Framework Lanjutan (CRUD)

## Langkah - Langkah Praktikum :

## Persiapan
Untuk Memulai membuat aplikasi CRUD sederhana, yang perlu disiapkan adalah database server menggunakan MySQL. Pastikan MySQL Server sudah dapat dijalankan melalui XAMPP Control Panel.

## Membuat Database 
```
CREATE DATABASE lab_ci4;
```

![New_Database](img/newdatabase.png)

## Membuat Tabel
```
CREATE TABLE artikel (
  id INT(11) auto_increment,
  judul VARCHAR(200) NOT NULL,
  isi TEXT,
  gambar VARCHAR(200),
  status TINYINT(1) DEFAULT 0,
  slug VARCHAR(200),
  PRIMARY KEY(id)
);
```

![New_table](img/newtable.png)

![Tabke](img/table.png)

## Konfigurasi Koneksi Database
Selanjutnya membuat konfigurasi untuk menghubungkan dengan database server. Konfigurasi dapat dilakukan dengan dua acara, yaitu pada file **app/config/database.php** atau menggunakan file **.env**. Pada praktikum ini kita gunakan konfigurasi pada file **.env**.

![img](img/env1.png)

## Membuat Model
Selanjutnya adalah membuat Model untuk memproses data Artikel. Buat file baru pada direktori **app/Models** dengan nama **ArtikelModel.php**.

![img](img/artikelmodel.png)

## Membuat Controller
Buat Controllers baru dengan nama **Artikel.php** pada direktori **app/Controllers**.

![img](img/artikel.png)

## membuat View
Buat direktori baru dengan nama **artikel** pada direktori **app/view**, kemudian buat file baru dengan nama **index.php**.

![img](img/index.png)

Selanjutnya buka browser kembali, dengan mengakses url `http://localhost:8080/artikel`

![img](img/belumadadata.png)

Belum ada data yang ditampilkan. Kemudian tambahkan beberapa data pada database agar dapat ditampilkan dataya.

![img](img/data.png)

```
INSERT INTO artikel (judul, isi, slug) VALUE 
('Artikel pertama', 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf.', 'artikel-pertama'),
('Artikel kedua', 'Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih dari 2000 tahun.', 'artikel-kedua');
 ```

Refresh kembali browser, sehingga akan ditampilkan hasilnya.